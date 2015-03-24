<?php

add_action( 'genesis_setup', 'b93_theme_setup', 15 );
/**
 * Theme setup.
 *
 * @since 1.0.0
 */
function b93_theme_setup() {
  // Child theme (do not remove)
  define( 'CHILD_THEME_NAME', 'Base93' );
  define( 'CHILD_THEME_URL', 'http://base93.com/' );
  define( 'CHILD_THEME_VERSION', '1' );

  // Add HTML5 markup structure
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

  // adding post format support
  // add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ));

  // adding support for post format images
  // add_theme_support( 'genesis-post-format-images' );

  // Unregister layouts
  //genesis_unregister_layout( 'content-sidebar' );
  //genesis_unregister_layout( 'sidebar-content' );
  //genesis_unregister_layout( 'content-sidebar-sidebar' );
  //genesis_unregister_layout( 'sidebar-sidebar-content' );
  //genesis_unregister_layout( 'sidebar-content-sidebar' );
  //genesis_unregister_layout( 'full-width-content' );

  // Add viewport meta tag for mobile browsers
  add_theme_support( 'genesis-responsive-viewport' );

  // Add support for 3-column footer widgets
  add_theme_support( 'genesis-footer-widgets', 3 );

  // Remove the site description because we're using an inline logo b93_header_inline_logo())
  remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

  // Remove edit post/page link
  add_filter ( 'genesis_edit_post_link' , '__return_false' );

  // Show Author Box (http://my.studiopress.com/snippets/author-box/)
  // add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );
  // add_filter( 'get_the_author_genesis_author_box_archive', '__return_true' );
}


add_action( 'wp_enqueue_scripts', 'b93_enqueue_scripts_styles' );
/**
 * Enqueue scripts and styles
 * @return  enqueued scripts and stylesheets
 */
function b93_enqueue_scripts_styles() {
}

add_filter( 'body_class', 'b93_body_class' );
/**
 * Add custom body class to the body tag
 * @param  array $classes array of css classes added to the body element
 * @return array          array of css classes (including ours) added to the body element
 */
function b93_body_class( $classes ) {
  $classes[] = '';
  return $classes;
}

add_filter( 'genesis_seo_title', 'b93_header_inline_logo', 10, 3 );
/**
 * Remove the default site title and replace with an image tag
 * @param  string $title  site title
 * @param  string $inside wrap the logo in an anchor tag via sprintf
 * @param  string $wrap   check if we're on the front page or not and show either a <p> tag or <h1> tag
 * @return mixed          site title replaced with an image tag
 */
function b93_header_inline_logo( $title, $inside, $wrap ) {

  $logo = '<img src="' . get_stylesheet_directory_uri() . '/images/ab-logo-rd-80.png" width="155" height="80" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';

  $inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );

  //* Determine which wrapping tags to use - changed is_home to is_front_page to fix Genesis bug
  $wrap = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

  //* A little fallback, in case an SEO plugin is active - changed is_home to is_front_page to fix Genesis bug
  $wrap = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;

  //* And finally, $wrap in h1 if HTML5 & semantic headings enabled
  $wrap = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;

  return sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );

}

add_filter( 'comment_form_defaults', 'b93_remove_comment_form_allowed_tags' );
/**
 * Remove the allowed tags from the comment form
 * @param  array $defaults array of values
 * @return array           empty list of comment allowed tags
 */
function b93_remove_comment_form_allowed_tags( $defaults ) {
    $defaults['comment_notes_after'] = '';
    return $defaults;
}

add_filter( 'genesis_author_box_gravatar_size', 'b93_author_box_gravatar' );
/**
 * Modify gravatar size in author box
 * @param  string $size avatar size
 * @return string       modified avatar size
 */
function b93_author_box_gravatar( $size ) {
    return 160;
}

add_filter( 'genesis_comment_list_args', 'b93_comments_gravatar' );
/**
 * Modify avatar size in comments list
 * @param  array $args array of arguments
 * @return array       modified size of avatar in comment list
 */
function b93_comments_gravatar( $args ) {
    $args['avatar_size'] = 100;
    return $args;
}
