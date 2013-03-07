<?php

add_filter('widget_text', 'do_shortcode');

if (!function_exists('responsive_post_meta_data')) :

function responsive_post_meta_data() {

	$archive_year  = get_the_time('Y');
	$archive_month = get_the_time('m');

	printf( __( '%1$s <span class="time">on %2$s</span> <span class="tags">%3$s</span>', 'responsive' ), 

	sprintf( '<span class="author"><a href="%1$s" title="%2$s">%3$s</a></span>',
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		sprintf( esc_attr__( 'View all by %s', 'responsive' ), get_the_author() ),
		get_the_author()
	    ),

	sprintf( '<a href="%1$s" title="Published at %2$s">%3$s</a>',
		get_month_link($archive_year, $archive_month),
		esc_attr( get_the_time() ),
		get_the_date()
		),

	sprintf(__('%s', 'responsive'),
		get_the_tag_list(' &#8211; Tagged ',', ')
		)
	);
}
endif;

if (!function_exists('responsive_setup')):
    function responsive_setup() {
    
    register_nav_menus(array(
			'top-menu'         => __('Top Menu', 'responsive'),
	        'header-menu'      => __('Header Menu', 'responsive'),
	        'sub-header-menu'  => __('Sub-Header Menu', 'responsive'),
			'footer-menu'      => __('Footer Menu', 'responsive')
		    )
	    );
    
    if (function_exists('get_custom_header')) {		
		add_theme_support('custom-header', array (
	        // Header image default
	       'default-image'			=> get_stylesheet_directory_uri() . '/images/default-logo.png',
	        // Header text display default
	       'header-text'			=> false,
	        // Header image flex width
		   'flex-width'             => true,
	        // Header image width (in pixels)
	       'width'				    => 400,
		    // Header image flex height
		   'flex-height'            => true,
	        // Header image height (in pixels)
	       'height'			        => 100,
	        // Admin header style callback
	       'admin-head-callback'	=> 'responsive_admin_header_style'));
	       
	       // gets included in the admin header
        function responsive_admin_header_style() {
            ?><style type="text/css">
                .appearance_page_custom-header #headimg {
					background-repeat:no-repeat;
					border:none;
				}
             </style><?php
        }		    
	    } else {
        define('HEADER_TEXTCOLOR', '');
        define('HEADER_IMAGE', '%s/images/default-logo.png'); // %s is the template dir uri
        define('HEADER_IMAGE_WIDTH', 300); // use width and height appropriate for your theme
        define('HEADER_IMAGE_HEIGHT', 100);
        define('NO_HEADER_TEXT', true);
        function responsive_admin_header_style() {
            ?><style type="text/css">
                #headimg {
	                background-repeat:no-repeat;
                    border:none !important;
                    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
                    height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;
                }
             </style><?php
         }      
		 add_custom_image_header('', 'responsive_admin_header_style');		
	    }
    }
endif;

function childtheme_favicon() { ?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico"><?php }
add_action('wp_head', 'childtheme_favicon');

?>