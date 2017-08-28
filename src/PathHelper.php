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
 * Class PathHelper.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class PathHelper {

	/**
	 * Regex pattern to detect whether an URI is absolute or not.
	 *
	 * Note: This is taken from Drupal 7 code.
	 *
	 * @since 0.1.0
	 */
	const ABSOLUTE_PATH_PATTERN =
		"/^(?:ftp|https?|feed):\/\/(?:(?:(?:[\w\.\-\+!$&'\(\)*\+,;=]|%[0-9a-f]"
		. "{2})+:)*(?:[\w\.\-\+%!$&'\(\)*\+,;=]|%[0-9a-f]{2})+@)?(?:(?:[a-z0-9"
		. "\-\.]|%[0-9a-f]{2})+|(?:\[(?:[0-9a-f]{0,4}:)*(?:[0-9a-f]{0,4})\]))("
		. "?::[0-9]+)?(?:[\/|\?](?:[\w#!:\.\?\+=&@$'~*,;\/\(\)\[\]\-]|%[0-9a-f"
		. "]{2})*)?$/xi";

	/**
	 * Check that the URI has the correct extension.
	 *
	 * Optionally adds the extension if none was detected.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri       URI to check the extension of.
	 * @param string $extension Extension to use.
	 *
	 * @return string URI with correct extension.
	 */
	public static function check_extension( $uri, $extension ) {
		$detected_extension = pathinfo( $uri, PATHINFO_EXTENSION );

		if ( $extension !== $detected_extension ) {
			$uri .= '.' . $extension;
		}

		return $uri;
	}

	/**
	 * Turn a relative URI into an absolute URI.
	 *
	 * If the URI is detected as being relative, it is assumed to be relative
	 * to the plugin root folder.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri  URI to make absolute.
	 * @param string $root Root folder to use.
	 *
	 * @return string Absolute URI.
	 */
	public static function make_absolute( $uri, $root ) {
		if ( ! static::is_absolute_path( $uri ) ) {
			$uri = $root . $uri;
		}

		return $uri;
	}

	/**
	 * Check whether a given URI is absolute or not.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri URI to check.
	 *
	 * @return bool Whether the URI is absolute or not.
	 */
	public static function is_absolute_path( $uri ) {
		return (bool) preg_match( static::ABSOLUTE_PATH_PATTERN, $uri );
	}
}
