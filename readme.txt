=== WP Morphext ===
Contributors: nateinaction
Tags: shortcode, text, animation
Requires at least: 3.0.1
Tested up to: 5.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Morphext is a WordPress Plugin that allows for users to add shortcodes to animate text on their website. The plugin uses shortcodes to provide a native WordPress interface for using the morphext.js and animate.css libraries.

**Options**

1. *animation* (flipInX is default), `[wpmorphext animation=“fadeIn” text=“Example 1, Example 2, etc”]`

2. *speed* (3000 milliseconds is default), `[wpmorphext speed=“1500” text=“Example 1, Example 2, etc”]`

For a list of all animations please visit [Animate.css](https://daneden.github.io/animate.css/)

**Important Note**
Some animations travel the entirety of the viewport. To limit where the animation can be seen you must set the parent container as `overflow: hidden;`

**Dependencies**

1. **Animate.css** — [Homepage](https://daneden.github.io/animate.css/) — [MIT License](https://opensource.org/licenses/MIT)

2. **Morphext** — [Homepage](http://morphext.fyianlai.com/) — [MIT License](http://ian.mit-license.org/)

**License**
GPLv2 (or later)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/wp-morphext` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. On a post or page type `[wpmorphext text="Example 1, Example 2, etc"]`

== Changelog ==
= 1.4.0 =
* Update animate.css from v2.5.1 to v3.7.0
* Improve performance by using minified animate.css
* Improve performance by inlining small custom css

= 1.3.1 =
* Fix namespace issue

= 1.3.0 =
* Now with automated tests and WPCS linting

= 1.2.0 =
* Updated morphext.js from v2.4.4 to v2.4.5

= 1.1.0 =
* Now capable of displaying multiple animated shortcodes on single page.

= 1.0.0 =
* Pushing the baby out of the nest.
