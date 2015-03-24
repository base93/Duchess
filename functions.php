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
