<?php
/**
 * Plugin Name: WP Morphext
 * Plugin URI: https://github.com/nateinaction/wp-morphext
 * Description: WP Morphext adds easy shortcode access to the Morphext text animation library. Example use: [wpmorphext animation="fadeIn" speed="3000" text="Example 1, Example 2, etc"]
 * Version: 1.4.0
 * Author: Nate Gay
 * Author URI: https://github.com/nateinaction
 * License: GPL2+
 *
 * @category WordPress_Plugin
 * @package  wp-morphext
 * @author   Nate Gay <email@nategay.me>
 * @license  GPL2+
 * @link     https://github.com/nateinaction/wp-morphext
 */

namespace WpMorphext;

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue Morphext scripts
 *
 * @return void
 */
function enqueue_scripts() {
	$resource_version = '1.4.0';
	wp_enqueue_style(
		'animate-css',
		plugins_url( '/css/animate.min.css', __FILE__ ),
		array(),
		$resource_version
	);
	wp_enqueue_script(
		'morphext-js',
		plugins_url( '/js/morphext.min.js', __FILE__ ),
		array( 'jquery' ),
		$resource_version,
		false
	);
}
add_action( 'wp_enqueue_scripts', 'WpMorphext\enqueue_scripts' );

/**
 * Inline CSS added for each animated element on a page
 *
 * @return void
 */
function add_inline_css() {  ?>
	<style>
	.morphext > .animated {
		display: inline-block;
	}
	</style>
	<?php
};
add_action( 'wp_head', 'WpMorphext\add_inline_css' );

/**
 * Inline JS added for each animated element on a page
 *
 * @return void
 */
function add_inline_js() {
	?>
	<script type='text/javascript'>
	function wpMorphext() {
		jQuery('.wp-morphext').each(function() {
			var morphextAnimation = jQuery(this).data('animation'),
				morphextSpeed = jQuery(this).data('speed');
			jQuery(this).Morphext({
				animation: morphextAnimation,
				separator: ',',
				speed: morphextSpeed
			}).show();
		});
	};
	wpMorphext();
	</script>
	<?php
};
add_action( 'wp_footer', 'WpMorphext\add_inline_js' );

/**
 * Add the shortcode
 *
 * @param  array $atts Array of attributes passed into the shortcode.
 *
 * @return string HTML span element
 */
function shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'animation' => 'flipInX',
			'speed'     => '3000',
			'text'      => 'Example 1, Example 2, Example 3',
		),
		$atts
	);
	return '<span style="display:none;" class="wp-morphext" data-animation="' . esc_attr( $atts['animation'] ) . '" data-speed="' . esc_attr( $atts['speed'] ) . '">' . esc_attr( $atts['text'] ) . '</span>';
};
add_shortcode( 'wpmorphext', 'WpMorphext\shortcode' );
