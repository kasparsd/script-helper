<?php
/*
Plugin Name: Script Helper
Plugin URI: 
Description: Includes <code>script_helper_header</code> and <code>script_helper_footer</code> option values in wp_head and wp_footer respectively
Author: Kaspars Dambis
Version: 0.1
Author URI: http://konstruktors.com
*/


register_activation_hook( __FILE__, 'script_helper_activate' );

function script_helper_activate() {

	add_option( 'script_helper_header', '' );
	add_option( 'script_helper_footer', '' );

}


add_action( 'wp_footer', 'script_helper_footer', 20 );

function script_helper_footer() {

	$scripts = trim( get_option( 'script_helper_footer', '' ) );

	if ( empty( $scripts ) )
		return;

	echo $script;

}
