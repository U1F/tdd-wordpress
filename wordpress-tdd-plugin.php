<?php
/**
 * The main file of the plugin.
 *
 * Plugin Name:       WordPress TDD Plugin
 * Plugin URI:        https://marioyepes.com
 * Description:       Example plugin on how to use TDD in WordPress
 * Version:           1.0.0
 * Requires at least: 4.0
 * Requires PHP:      7.2
 * Author:            Mario Yepes
 * Author URI:        https://marioyepes.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wp-tdd
 * Domain Path:       /languages
 *
 * @package WordPress_TDD_Plugin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the shortcode.
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content Shortcode content.
 *
 * @return string
 */
function create_shorcode_tdd_plugin( $atts, $content = '' ) {

	$default_font  = get_option( 'tdd_font', 'Arial, Helvetica, sans-serif' );
	$default_color = get_option( 'tdd_color', '' );

	$atts = shortcode_atts(
		array(
			'font'   => $default_font,
			'color'  => $default_color,
			'weight' => 'normal',
		),
		$atts
	);

	return '<div style="font-family: ' . $atts['font'] . '; color: ' . $atts['color'] .
	'; font-weight: ' . $atts['weight'] . '">' . $content . '</div>';
}

add_shortcode( 'tdd-shortcode', 'create_shorcode_tdd_plugin' );
