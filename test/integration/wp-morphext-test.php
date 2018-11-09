<?php
/**
 * Unit tests for the entry file of the Segment Cache for WP Engine plugin
 *
 * @package nateinaction/wp-morphext
 */

namespace WpMorphext;

/**
 * Unit tests for SetSegment shortcode class
 */
class Wp_Morphext_Test extends \WP_UnitTestCase {
	/**
	 * Verify shortcode has been added
	 */
	public function test_verify_shortcode_added() {
		$wpmorphext_shortcode = shortcode_exists( 'wpmorphext' );
		$this->assertTrue( $wpmorphext_shortcode );
	}

	/**
	 * Test display morphext content
	 */
	public function test_display_morphext_content() {
		$atts = array(
			'animation' => 'super-cool-flip123',
			'speed'     => '2',
			'text'      => 'Nik, nak, paddy wak',
		);

		$expect_animation = 'data-animation="super-cool-flip123"';
		$expect_speed = 'data-speed="2"';
		$expect_text = '>Nik, nak, paddy wak</span>';
		$shortcode_output = wp_morphext_shortcode( $atts );

		$this->assertContains( $expect_animation, $shortcode_output );
		$this->assertContains( $expect_speed, $shortcode_output );
		$this->assertContains( $expect_text, $shortcode_output );
	}
}
