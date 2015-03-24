<?php
/**
 * This is a helper file to help when using the Google Maps functionality that
 * is offered by the Advanced Custom Fields Plugin.
 *
 * To use, simply include this file on in the template that will be showing the
 * Google Map. It will then take care of loading the necessary scripts and
 * styles to display the map and make it work. Make sure to update the field name
 * on line #19 to reflect the name you gave the Maps field.
 *
 * @link http://www.advancedcustomfields.com/resources/google-map/
 */

/**
 * Grab the location field from Advaned Custom Fields
 * Make sure that the field name is the same as what you created in the admin backend
 * @var string
 */
$b93_acf_map_check = get_field('location');


//* Enqueue Advanced Custom Fields Maps Scripts & Styles
add_action( 'wp_enqueue_scripts', 'b93_acf_maps_helper_scripts' );
function b93_acf_maps_helper_scripts() {

  if( !empty($location) ) :
    // CSS
    wp_enqueue_style( 'acf-b93-frontend', get_stylesheet_directory_uri() . '/assets/css/b93-acf-frontend.css','', '1', all );

    // JS
    wp_enqueue_script( 'acf-google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array('jquery'), '3', true );
    wp_enqueue_script( 'acf-google-maps-init', get_stylesheet_directory_uri() . '/assets/js/min/acf-google-maps-min.js', array('acf-google-maps'), '1', true );
  endif;
}
