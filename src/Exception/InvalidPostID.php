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
 * Class InvalidPostID.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidPostID extends \InvalidArgumentException implements SpeakingPageException {

	/**
	 * Create a new instance of the exception for a post ID that is not valid.
	 *
	 * @since 0.1.0
	 *
	 * @param int $id Post ID that is not valid
	 *
	 * @return static
	 */
	public static function from_id( $id ) {
		$message = sprintf(
			'The post ID "%d" is not valid.',
			$id
		);

		return new static( $message );
	}
}
