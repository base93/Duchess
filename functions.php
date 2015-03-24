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

  // Remove edit post/page link
  add_filter ( 'genesis_edit_post_link' , '__return_false' );
}
