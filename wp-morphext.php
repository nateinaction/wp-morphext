<?php

/**
 * Plugin Name: WP Morphext
 * Plugin URI: https://nategay.me/
 * Description: WP Morphext adds easy shortcode access to the Morphext text animation library. Example use: [wpmorphext animation="fadeIn" speed="3000" text="Example 1, Example 2, etc"]
 * Version: 1.0
 * Author: Nate Gay
 * Author URI: https://nategay.me/
 * License: GPL2
 */


function wp_morphext_scripts() {
    wp_enqueue_style( 'animate-css', plugins_url( '/css/animate.css', __FILE__ ));
    wp_enqueue_style( 'morphext-css', plugins_url( '/css/morphext.css', __FILE__, array('animate-css') ));
    wp_enqueue_script( 'morphext-js', plugins_url( '/js/morphext.min.js', __FILE__ ), array('jquery'), '1.0', false);
}
add_action('wp_enqueue_scripts','wp_morphext_scripts');

function wp_morphext(){
?>
	<script type='text/javascript'>
    function wpMorphext() {
      var morphextAnimation = jQuery('#wp-morphext').data('animation'),
          morphextSpeed = jQuery('#wp-morphext').data('speed');
      jQuery('#wp-morphext').Morphext({
        animation: morphextAnimation,
        separator: ',',
        speed: morphextSpeed
      }).show();
    };
    wpMorphext();
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

	return '<span style="display:none;" id="wp-morphext" data-animation="'.esc_attr($atts['animation']).'" data-speed="'.esc_attr($atts['speed']).'">'.esc_attr($atts['text']).'</span>';
};
add_shortcode( 'wpmorphext', 'wp_morphext_shortcode' );
