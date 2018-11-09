<?php
/**
 * Plugin Name: WP Morphext
 * Plugin URI: https://nategay.me/
 * Description: WP Morphext adds easy shortcode access to the Morphext text animation library. Example use: [wpmorphext animation="fadeIn" speed="3000" text="Example 1, Example 2, etc"]
 * Version: 1.3
 * Author: Nate Gay
 * Author URI: https://nategay.me/
 * License: GPL2+
 *
 * @package nateinaction/wp-morphext
 */

namespace WpMorphext;

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue Morphext scripts
 */
function wp_morphext_enqueue_scripts() {
	$resource_version = '1.3';
	wp_enqueue_style(
		'animate-css',
		plugins_url( '/css/animate.css', __FILE__ ),
		array(),
		$resource_version
	);
	wp_enqueue_style(
		'morphext-css',
		plugins_url( '/css/morphext.css', __FILE__, array( 'animate-css' ) ),
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
add_action( 'wp_enqueue_scripts', 'wp_morphext_enqueue_scripts' );

/**
 * Inline JS added for each animated element on a page
 */
function wp_morphext() {
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
add_action( 'wp_footer', 'wp_morphext' );

/**
 * Add the shortcode
 *
 * @param array $atts Array of attributes passed into the shortcode.
 */
function wp_morphext_shortcode( $atts ) {
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
add_shortcode( 'wpmorphext', 'wp_morphext_shortcode' );
