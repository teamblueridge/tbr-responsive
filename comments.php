<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Comments Template
 *
 *
 * @file           comments.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2010 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/comments.php
 * @link           http://codex.wordpress.org/Theme_Development#Comments_.28comments.php.29
 * @since          available since Release 1.0
 */
?>
<?php if (post_password_required()) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view any comments.', 'responsive'); ?></p>
    
	<?php return; } ?>

<?php if (have_comments()) : ?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','responsive' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','responsive', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

	<div id="comments"></div>
    <ol class="commentlist">
        <?php wp_list_comments('avatar_size=40&type=comment&reply_text=Answer&callback=tbr_comment'); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','responsive' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','responsive', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php if (comments_open()) : ?>

    <?php
    $args = array(
    'title_reply' => '',
    'title_reply_to' => '',
    'cancel_reply_link' => __('Dismiss your answer.'),
    'label_submit' => __('Reply'),
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'logged_in_as' => '',
    'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Content" type="text" cols="45" rows="6" aria-required="true"></textarea></p>',
    'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<p class="comment-form-author">' . '<input id="author" name="author" placeholder="Name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email' => '<p class="comment-form-email">' . '<input id="email" name="email" placeholder="Email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url' => '<p class="comment-form-url">' . '<input id="url" name="url" placeholder="Website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
		) ) );
    
    comment_form($args);
    ?>

    <?php endif; ?>
