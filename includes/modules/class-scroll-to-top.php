<?php
/**
 * Scroll to Top
 *
 * Displays scroll to top button based on theme options
 *
 * @package WorldStar Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Scroll to Top Class
 */
class WorldStar_Pro_Scroll_To_Top {

	/**
	 * Scroll to Top Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if WorldStar Theme is not active.
		if ( ! current_theme_supports( 'worldstar-pro' ) ) {
			return;
		}

		// Enqueue Scroll-To-Top JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add Scroll-To-Top Checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'scroll_to_top_settings' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = WorldStar_Pro_Customizer::get_theme_options();

		// Call Credit Link function of theme if credit link is activated.
		if ( true === $theme_options['scroll_to_top'] ) :

			wp_enqueue_script( 'worldstar-pro-scroll-to-top', WORLDSTAR_PRO_PLUGIN_URL . 'assets/js/scroll-to-top.js', array( 'jquery' ), WORLDSTAR_PRO_VERSION, true );

		endif;
	}

	/**
	 * Add scroll to top checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function scroll_to_top_settings( $wp_customize ) {

		// Add Scroll to Top headline.
		$wp_customize->add_control( new WorldStar_Customize_Header_Control(
			$wp_customize, 'worldstar_theme_options[scroll_top_title]', array(
				'label' => esc_html__( 'Scroll to Top', 'worldstar-pro' ),
				'section' => 'worldstar_pro_section_footer',
				'settings' => array(),
				'priority' => 10,
			)
		) );

		// Add Scroll to Top setting.
		$wp_customize->add_setting( 'worldstar_theme_options[scroll_to_top]', array(
			'default'           => false,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'worldstar_theme_options[scroll_to_top]', array(
			'label'    => __( 'Display Scroll to Top Button', 'worldstar-pro' ),
			'section'  => 'worldstar_pro_section_footer',
			'settings' => 'worldstar_theme_options[scroll_to_top]',
			'type'     => 'checkbox',
			'priority' => 20,
		) );
	}
}

// Run Class.
add_action( 'init', array( 'WorldStar_Pro_Scroll_To_Top', 'setup' ) );
