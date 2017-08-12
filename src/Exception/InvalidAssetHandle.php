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

namespace AlainSchlesser\Speaking\Exception;

/**
 * Class InvalidAssetHandle.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidAssetHandle extends \InvalidArgumentException implements SpeakingPageException {

	/**
	 * Create a new instance of the exception for a asset handle that is not
	 * valid.
	 *
	 * @since 0.1.0
	 *
	 * @param int $handle Asset handle that is not valid.
	 *
	 * @return static
	 */
	public static function from_handle( $handle ) {
		$message = sprintf(
			'The asset handle "%s" is not valid.',
			$handle
		);

		return new static( $message );
	}
}
