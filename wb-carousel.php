<?php
/**
 * Plugin Name:		   WB Carousel
 * Plugin URI:		   https://wpbrim.com/product/wb-carousel
 * Description:		   WB carousel is a responsive WordPress Carousel plugin .Users can add Image carousel in any WordPress Website.Add Image through custom post type and have category to pull image in the carousel from any specific category.WB carousel is an easy plugin works using shortcode .
 * Version: 		     1.0
 * Author: 			     wpbrim 
 * Author URI: 		   https://wpbrim.com/product/wb-carousel
 * Text Domain:      wb-carousel
 * License:          GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPL2
 */
// include files

/**
 * Protect direct access
 */

if( ! defined( 'WBCAROUSEL_HACK_MSG' ) ) define( 'WBCAROUSEL_HACK_MSG', __( 'Sorry ! You made a mistake !', 'wb-carousel' ) );
if ( ! defined( 'ABSPATH' ) ) die( WBCAROUSEL_HACK_MSG );


/**
 * Defining constants 
*/

if( ! defined( 'WBCAROUSEL_PLUGIN_DIR' ) ) define( 'WBCAROUSEL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if( ! defined( 'WBCAROUSEL_PLUGIN_URI' ) ) define( 'WBCAROUSEL_PLUGIN_URI', plugins_url( '', __FILE__ ) );


 include(plugin_dir_path( __FILE__ ).'/lib/cpt.php');
 include(plugin_dir_path( __FILE__ ).'/public/view.php');

 // Scripts
   function wb_carousel_enqueue_scripts() {

      // Vendors style & scripts
       wp_enqueue_style('owl.carousel', WBCAROUSEL_PLUGIN_URI.'/vendors/owl-carousel/assets/owl.carousel.min.css');
       wp_enqueue_script('owl-carousel', WBCAROUSEL_PLUGIN_URI.'/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), 1.0, true);
       wp_enqueue_style( 'font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
      //Plugin Main CSS File
       wp_enqueue_style( 'wb-carousel', WBCAROUSEL_PLUGIN_URI.'/assets/css/wb-carousel.css');

    }

   add_action( 'wp_enqueue_scripts', 'wb_carousel_enqueue_scripts' );

   // Adding Admin script

   add_action( 'admin_enqueue_scripts', 'wb_carousel_admin_style' );

   function wb_carousel_admin_style() {

    wp_enqueue_style( 'wb-carousel-admin', WBCAROUSEL_PLUGIN_URI.'/assets/css/wb-carousel-admin.css');

   }

  //  Setting API

   require_once WBCAROUSEL_PLUGIN_DIR  .'/lib/setting/wb-carousel-settings-api.php';
   require_once WBCAROUSEL_PLUGIN_DIR .'/lib/setting/wb-carousel-settings.php';

   new Wpbrim_Carousel_Settings_API_Test();

 // Scripts



 if ( function_exists( 'add_theme_support' ) ) {
     add_theme_support( 'post-thumbnails' );
 }

 /* Move Featured Image Below Title */

 function wpbrim_move_featured_image_box() {
     remove_meta_box( 'postimagediv', 'wb_carousel', 'side' );
     add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'wb_carousel', 'normal', 'high');

 }
 add_action('do_meta_boxes', 'wpbrim_move_featured_image_box');


 // add submenu page

 add_action('admin_menu', 'wpbrim_carousel_menu_init');



 function wpbrim_carousel_menu_help(){
   include('lib/wb-carousel-help-upgrade.php');
 }

 function wpbrim_carousel_menu_init()
   {

     add_submenu_page('edit.php?post_type=wb_carousel', __('Help & Upgrade','wb-carousel'), __('Help & Upgrade','wb-carousel'), 'manage_options', 'wpbrim_carousel_menu_help', 'wpbrim_carousel_menu_help');

   }


include('lib/wb-carousel-column.php');

// After Plugin Activation redirect

 if( !function_exists( 'wpbrim_carousel_activation_redirect' ) ){
   function wb_carousel_activation_redirect( $plugin ) {
       if( $plugin == plugin_basename( __FILE__ ) ) {
           exit( wp_redirect( admin_url( 'edit.php?post_type=wb_carousel&page=wpbrim_carousel_menu_help' ) ) );
       }
   }
 }
 add_action( 'activated_plugin', 'wpbrim_carousel_activation_redirect' );


