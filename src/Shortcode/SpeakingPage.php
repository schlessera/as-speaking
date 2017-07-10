<?php
/**
 * AlainSchlesser.com Speaking Page Plugin.
 *
 * @package   AlainSchlesser\Speaking
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.alainschlesser.com/
 * @copyright 2017 Alain Schlesser
 */

namespace AlainSchlesser\Speaking\Shortcode;

/**
 * Class SpeakingPage.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class SpeakingPage extends BaseShortcode {

	const TAG      = 'speaking_page';
	const VIEW_URI = 'views/speaking-page';

	/**
	 * Get the tag to use for the shortcode.
	 *
	 * @since 0.1.0
	 */
	protected function get_tag() {
		return self::TAG;
	}

	/**
	 * Get the View URI to use for rendering the shortcode.
	 *
	 * @since 0.1.0
	 */
	protected function get_view_uri() {
		return self::VIEW_URI;
	}

	/**
	 * Process the shortcode attributes.
	 *
	 * @since 0.1.0
	 *
	 * @param array|string $atts Raw shortcode attributes passed into the
	 *                           shortcode function.
	 *
	 * @return array Processed shortcode attributes.
	 */
	protected function process_attributes( $atts ) {
		return shortcode_atts(
			[
				// Shortcode attributes' default values.
			],
			$atts,
			self::TAG
		);
	}
}
