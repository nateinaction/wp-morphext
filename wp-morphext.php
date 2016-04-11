<?php

/**
 * Plugin Name: WP Morphext
 * Plugin URI: https://nategay.me/
 * Description: WP Morphext adds easy shortcode access to the Morphext text manipulation library.
 * Version: 1.0
 * Author: Nate Gay
 * Author URI: https://nategay.me/
 * License: GPL2
 */


function wp_morphext_init() {
    wp_enqueue_script( 'morphext-js', plugins_url( '/js/morphext.min.js', __FILE__ ), array('jquery'), '1.0', false);
    wp_enqueue_style( 'animate-css', plugins_url( '/css/animate.css', __FILE__ ));
    wp_enqueue_style( 'morphext-css', plugins_url( '/css/morphext.css', __FILE__, array('animate-css') ));
}
add_action('wp_enqueue_scripts','wp_morphext_init');

function wp_morphext(){
?>
	<script type='text/javascript'>
    jQuery('.wp-morphext').Morphext({
      animation: 'flipInX',
      separator: ',',
      speed: '3000'
    });
    jQuery('.wp-morphext').show();
	</script>
<?php
};
add_action('wp_footer','wp_morphext');

function wp_morphext_shortcode($atts, $content = null){

	$atts = shortcode_atts( array(
		'animation' => 'flipInX',
		'speed'     => '3000',
		'text'      => 'Example 1, Example 2, Example 3'
	), $atts );

	return '<span style="display:none;" class="wp-morphext">'.esc_attr($atts['text']).'</span>';
};
add_shortcode( 'wpmorphext', 'wp_morphext_shortcode' );
