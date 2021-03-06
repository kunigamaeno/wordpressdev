<?php
/**
 * Plugin Name: Browser Shots
 * Plugin URI: https://wordpress.org/plugins/browser-shots/
 * Description: Easily take dynamic screenshots of a website inside of WordPress
 * Author: Ben Gillbanks
 * Version: 1.5.1
 * Author URI: https://prothemedesign.com
 * Text Domain: browser-shots
 */

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if ( ! class_exists( 'BrowserShots' ) ) {

	/**
	 * Browsershots is a class for making use of the wordpress.com 'mshots' functionality to automatically take screenshots of websites.
	 */
	class BrowserShots {

		/**
		 * Setup the object
		 *
		 * @param array $options An array of options for this object.
		 */
		function __construct( $options = array() ) {

			add_shortcode( 'browser-shot', array( $this, 'shortcode' ) );
			add_action( 'init', array( $this, 'tinymce_button' ) );

		}


		/**
		 * [browser-shot] Shortcode
		 *
		 * Create a shortcode: [browser-shot url="http://link-to-website" width="600"]
		 *
		 * @param array  $attributes Shortcode properties.
		 * @param string $content Content of shortcode.
		 * @param string $code Code.
		 * @return string
		 */
		public function shortcode( $attributes, $content = '', $code = '' ) {

			// Get attributes as parameters.
			extract(
				shortcode_atts(
					array(
						'url' => '',
						'width' => 600,
						'height' => 450,
						'alt' => '',
						'link' => '',
						'target' => '',
						'class' => '',
						'image_class' => 'alignnone',
					),
					$attributes
				)
			);

			if ( empty( $alt ) ) {

				$alt = esc_url( $url );

			}

			if ( empty( $link ) ) {

				$link = esc_url( $url );

			}

			if ( $target ) {

				$target = ' target="' . esc_attr( $target ) . '"';

			}

			// Get screenshot.
			$image_uri = $this->get_shot( $url, $width, $height );

			if ( ! empty( $image_uri ) ) {

				ob_start();

				if ( ! empty( $content ) ) {
					echo '<div class="wp-caption" style="width:' . ( intval( $width ) + 10 ) . 'px;">';
				}
?>
		<div class="browser-shot <?php echo esc_attr( $class ); ?>">
			<a href="<?php echo esc_url( $link ); ?>" <?php echo esc_html( $target ); ?>>
				<img src="<?php echo esc_url( $image_uri ); ?>" alt="<?php echo esc_attr( $alt ); ?>" width="<?php echo intval( $width ); ?>" height="<?php echo intval( $height ); ?>" class="<?php echo esc_attr( $image_class ); ?>" />
			</a>
		</div>
<?php
				if ( ! empty( $content ) ) {
					echo '<p class="wp-caption-text">' . esc_html( $content ) . '</p></div>';
				}

				return ob_get_clean();

			}

			return '';

		}


		/**
		 * Get Browser Screenshot
		 *
		 * Get a screenshot of a website using WordPress
		 *
		 * @param string $url Url of screenshot.
		 * @param int    $width Width of screenshot.
		 * @param int    $height Height of screenshot.
		 * @return string
		 */
		public function get_shot( $url = '', $width = 600, $height = 450 ) {

			// Image found.
			if ( '' !== $url ) {

				$query_args = array(
					'w' => intval( $width ),
					'h' => intval( $height ),
				);

				return add_query_arg( $query_args, 'https://s0.wordpress.com/mshots/v1/' . urlencode( esc_url( $url ) ) );

			}

			return '';

		}


		/**
		 * Register TinyMCE Button
		 *
		 * @param array $buttons List of TinyMCE buttons.
		 * @return array Modified list of TinyMCE buttons.
		 */
		public function register_button( $buttons ) {

			array_push( $buttons, '|', 'browsershots' );

			return $buttons;

		}


		/**
		 * Register TinyMCE Plugin
		 *
		 * @param array $plugins List of tinyMCE plugins already available.
		 * @return array Modified list of TinyMCE plugins
		 */
		public function add_plugin( $plugins ) {

			$plugins['browsershots'] = plugins_url( 'js/browser-shots.js' , __FILE__ );

			return $plugins;

		}


		/**
		 * Add translations to TinyMCE button
		 *
		 * @param array $locales List of TinyMCE plugin locales.
		 * @return array Modified list of TinyMCE plugin locales.
		 */
		public function button_locale( $locales ) {

			$locales['browsershots'] = plugin_dir_path( __FILE__ ) . 'locale.php';

			return $locales;

		}


		/**
		 * Create TinyMCE Button
		 */
		public function tinymce_button() {

			// Capabilities check.
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {

				return;

			}

			if ( get_user_option( 'rich_editing' ) == 'true' ) {

				add_filter( 'mce_external_plugins', array( $this, 'add_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_button' ) );
				add_filter( 'mce_external_languages', array( $this, 'button_locale' ) );

			}
		}
	}

	new BrowserShots();

} // class_exists
