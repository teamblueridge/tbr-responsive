<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * No-Posts Loop Content Template-Part File
 *
 * @file           loop-no-posts.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/loop-no-posts.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */

/**
 * If there are no posts in the loop,
 * display default content
 */ 
$title = ( is_search() ? sprintf(__('Damnit. We couldn&#39;t find something with %s.', 'responsive' ), get_search_query() ) : __( '404 &#8212; Entering the black hole!', 'responsive' ) );
?>

<h1 class="title-404"><?php echo $title; ?></h1>
						
<h6><?php 
printf( __( 'Time to %s or to try some other links.', 'responsive' ),
	sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
		esc_url( get_home_url() ),
		esc_attr__( 'Homepage', 'responsive' ),
		esc_attr__( 'escape', 'responsive' )
	) 
); 
?></h6>