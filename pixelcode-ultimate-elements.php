<?php

/*
 * Plugin Name:       PixelCode Ultimate Elements
 * Plugin URI:        https://github.com/developer-rafsan/wordpress-plugin.git
 * Description:       Pixel Code Ultimate Elementor Addons enhance your Elementor site with customizable widgets, animations, sliders, etc, and regular updates for improved functionality.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            PixelCode
 * Author URI:        https://portfolio-client-y9gw.onrender.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pixelcode
 */

 if ( ! defined( 'ABSPATH' ) ) exit; 


//  new caragory category create in elementor
function register_pixelcode_category( $elements_manager ) {
    $elements_manager->add_category(
        'pixelcode',
        [
            'title' => __( 'PixelCode', 'pixelcode' ),
            'icon'  => 'fa fa-code', 
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'register_pixelcode_category' );


function pixelcode_reating_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/pixelcode-reating-widgets.php' );
	$widgets_manager->register( new \PixelCode_Reating_Widgets() );

}
add_action( 'elementor/widgets/register', 'pixelcode_reating_widgets' );


