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
 * To test this function, you can use the following shortcode:
 * [tdd-shortcode font=monospace weight=900 color=red]Hello, world![/tdd-shortcode]
 *
 * @param mixed  $atts Shortcode attributes.
 * @param string $content Shortcode content.
 *
 * @return string
 */
function create_shorcode_tdd_plugin( mixed $atts = '', string $content = '' ): string {

	$default_font  = get_option( 'tdd_font', 'Arial, Helvetica, sans-serif' );
	$default_color = get_option( 'tdd_color', '' );

	if ( '' === $atts) {
		$atts = array();
	}

	$filtered_atts = shortcode_atts(
		array(
			'font'   => $default_font,
			'color'  => $default_color,
			'weight' => 'normal',
		),
		$atts
	);
	ob_start();
	?>
	<div style="font-family: <?php echo esc_html( $filtered_atts['font'] ); ?>; color: <?php echo esc_html( $filtered_atts['color'] ); ?>; font-weight: <?php echo esc_html( $filtered_atts['weight'] ); ?>"><?php echo esc_html( $content ); ?></div>
	<?php
	$shortcode_html = ob_get_clean();
	if ( false !== $shortcode_html ) {
		return trim( $shortcode_html );
	}
	return '<div></div>';
}

add_shortcode( 'tdd-shortcode', 'create_shorcode_tdd_plugin' );
