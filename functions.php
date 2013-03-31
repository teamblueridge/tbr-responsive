<?php

//Allow shortcode execution in widgets
add_filter('widget_text', 'do_shortcode');

//Custom Post Meta with name, date, tag and comment numbers
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

//Customized comment layout, needed to reorganize/remove some parts
function tbr_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {$tag = 'div';$add_below = 'comment';} 
		else {$tag = 'li';$add_below = 'div-comment';}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<?php printf(get_comment_author_link()) ?> <?php edit_comment_link(__('(Edit)'),'  ','' ) ?>
		<div class="comment-answer">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>
		</div>
<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
<?php endif; ?>

		<div class="comment-metadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
		</div>

		<?php comment_text() ?>
	
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
        }


//Nothing special, just to allow different logo image size
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

//Let's load our own favicon
function childtheme_favicon() { ?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico"><?php }
add_action('wp_head', 'childtheme_favicon');

?>