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

namespace AlainSchlesser\Speaking;

/**
 * Class TemplatedView.
 *
 * Looks within the child theme and parent theme folders first for a view,
 * before defaulting to the plugin folder.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class TemplatedView extends View {

	/**
	 * Validate an URI.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri URI to validate.
	 *
	 * @return string Validated URI.
	 * @throws Exception\InvalidURI If an invalid URI was passed into the View.
	 */
	protected function validate( $uri ) {
		$uri = PathHelper::check_extension( $uri, static::VIEW_EXTENSION );

		foreach ( $this->get_locations( $uri ) as $location ) {
			if ( is_readable( $location ) ) {
				return $location;
			}
		}

		if ( ! is_readable( $uri ) ) {
			throw Exception\InvalidURI::from_uri( $uri );
		}

		return $uri;
	}

	/**
	 * Get the possible locations for the view.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri URI of the view to get the locations for.
	 *
	 * @return array Array of possible locations.
	 */
	protected function get_locations( $uri ) {
		return [
			STYLESHEETPATH . '/' . $uri,
			TEMPLATEPATH . '/' . $uri,
			AS_SPEAKING_DIR . $uri,
		];
	}
}
