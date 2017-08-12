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

namespace AlainSchlesser\Speaking\Assets;

use AlainSchlesser\Speaking\PathHelper;

/**
 * Class MinifiedStyleAsset.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Assets
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class MinifiedStyleAsset extends StyleAsset {

	/**
	 * Normalize the source URI.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri       Source URI to normalize.
	 * @param string $extension Default extension to use.
	 *
	 * @return string Normalized source URI.
	 */
	protected function normalize_source( $uri, $extension ) {
		if ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) {
			$extension = ".min{$extension}";
		}

		$uri = PathHelper::check_extension( $uri, $extension );
		$uri = PathHelper::make_absolute( $uri, AS_SPEAKING_URL );

		return $uri;
	}
}
