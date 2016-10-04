<?php
/**
 * Post Meta Settings
 *
 * Adds post meta settings to disable date, author or other meta information of posts
 *
 * @package WorldStar Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Post Meta Class
 */
class WorldStar_Pro_Post_Meta {

	/**
	 * Site Logo Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if WorldStar Theme is not active.
		if ( ! current_theme_supports( 'worldstar-pro' ) ) {
			return;
		}

		// Add Post Meta Settings.
		add_action( 'customize_register', array( __CLASS__, 'post_meta_settings' ) );

	}

	/**
	 * Adds post meta settings
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function post_meta_settings( $wp_customize ) {

		// Add Post Meta Settings.
		$wp_customize->add_setting( 'worldstar_theme_options[postmeta_headline]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control( new WorldStar_Customize_Header_Control(
			$wp_customize, 'worldstar_theme_options[postmeta_headline]', array(
				'label' => esc_html__( 'Post Meta', 'worldstar-pro' ),
				'section' => 'worldstar_section_post',
				'settings' => 'worldstar_theme_options[postmeta_headline]',
				'priority' => 4,
			)
		) );

		$wp_customize->add_setting( 'worldstar_theme_options[meta_date]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'worldstar_theme_options[meta_date]', array(
			'label'    => esc_html__( 'Display post date', 'worldstar-pro' ),
			'section'  => 'worldstar_section_post',
			'settings' => 'worldstar_theme_options[meta_date]',
			'type'     => 'checkbox',
			'priority' => 5,
			)
		);

		$wp_customize->add_setting( 'worldstar_theme_options[meta_author]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'worldstar_theme_options[meta_author]', array(
			'label'    => esc_html__( 'Display post author', 'worldstar-pro' ),
			'section'  => 'worldstar_section_post',
			'settings' => 'worldstar_theme_options[meta_author]',
			'type'     => 'checkbox',
			'priority' => 6,
			)
		);

		$wp_customize->add_setting( 'worldstar_theme_options[meta_category]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'worldstar_theme_options[meta_category]', array(
			'label'    => esc_html__( 'Display post categories', 'worldstar-pro' ),
			'section'  => 'worldstar_section_post',
			'settings' => 'worldstar_theme_options[meta_category]',
			'type'     => 'checkbox',
			'priority' => 7,
			)
		);

		// Add Post Footer Settings.
		$wp_customize->add_setting( 'worldstar_theme_options[single_posts_headline]', array(
			'default'           => '',
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control( new WorldStar_Customize_Header_Control(
			$wp_customize, 'worldstar_theme_options[single_posts_headline]', array(
				'label' => esc_html__( 'Single Posts', 'worldstar-pro' ),
				'section' => 'worldstar_section_post',
				'settings' => 'worldstar_theme_options[single_posts_headline]',
				'priority' => 8,
			)
		) );

		$wp_customize->add_setting( 'worldstar_theme_options[post_image]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'worldstar_theme_options[post_image]', array(
			'label'    => esc_html__( 'Display featured image on single posts', 'worldstar-pro' ),
			'section'  => 'worldstar_section_post',
			'settings' => 'worldstar_theme_options[post_image]',
			'type'     => 'checkbox',
			'priority' => 9,
			)
		);

		$wp_customize->add_setting( 'worldstar_theme_options[meta_tags]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'worldstar_theme_options[meta_tags]', array(
			'label'    => esc_html__( 'Display post tags on single posts', 'worldstar-pro' ),
			'section'  => 'worldstar_section_post',
			'settings' => 'worldstar_theme_options[meta_tags]',
			'type'     => 'checkbox',
			'priority' => 10,
			)
		);
		$wp_customize->add_setting( 'worldstar_theme_options[post_navigation]', array(
			'default'           => true,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'worldstar_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'worldstar_theme_options[post_navigation]', array(
			'label'    => esc_html__( 'Display post navigation on single posts', 'worldstar-pro' ),
			'section'  => 'worldstar_section_post',
			'settings' => 'worldstar_theme_options[post_navigation]',
			'type'     => 'checkbox',
			'priority' => 11,
			)
		);

	}
}

// Run Class.
add_action( 'init', array( 'WorldStar_Pro_Post_Meta', 'setup' ) );
