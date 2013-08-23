<?php
/*
Plugin Name: Script Helper
Plugin URI: https://github.com/kasparsd/script-helper
GitHub URI: https://github.com/kasparsd/script-helper
Description: Provides an easy way for adding styles and scripts to header (<code>wp_head</code>) and footer (<code>wp_footer</code>)
Author: Kaspars Dambis
Version: 1.1
Author URI: http://konstruktors.com
*/


add_action( 'wp_footer', 'script_helper_footer', 20 );

function script_helper_footer() {

	$script = trim( get_option( 'script_helper_footer' ) );

	if ( empty( $script ) )
		return;

	printf( "\n<!-- Script helper footer: -->\n%s\n\n", $script );

}


add_action( 'wp_header', 'script_helper_header', 20 );

function script_helper_header() {

	$script = trim( get_option( 'script_helper_header' ) );

	if ( empty( $script ) )
		return;

	printf( "\n<!-- Script helper header: -->\n%s\n\n", $script );

}


add_action( 'admin_init', 'register_script_helper_settings' );

function register_script_helper_settings() {

	if ( ! current_user_can( 'install_plugins' ) )
		return;

	register_setting( 'general', 'script_helper_header' );
	register_setting( 'general', 'script_helper_footer' );

	add_settings_field(
		'script_helper_settings', 
		__( 'Scripts', 'script-helper' ), 
		'script_helper_settings', 
		'general', 
		'default' 
	);

}

function script_helper_settings() {

	$scripts = array(
		'script_helper_header' => array(
			'title' => __( 'Header', 'script-helper' ),
			'value' => get_option( 'script_helper_header' )
		),
		'script_helper_footer' => array(
			'title' => __( 'Footer', 'script-helper' ),
			'value' => get_option( 'script_helper_footer' )
		)
	);

	foreach  ( $scripts as $option_key => $option )
		printf(
			'<p>
			<label>
				<strong>%s</strong>
				<textarea name="%s" rows="10" class="large-text code">%s</textarea>
			</label>
			</p>',
			esc_html( $option['title'] ),
			esc_attr( $option_key ),
			esc_html( $option['value'] )
		);

}

