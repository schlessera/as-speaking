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
 * Class InvalidService.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidService extends \InvalidArgumentException implements SpeakingPageException {

	/**
	 * Create a new instance of the exception for a service class name that is
	 * not recognized.
	 *
	 * @since 0.1.0
	 *
	 * @param string $service Class name of the service that was not recognized.
	 *
	 * @return static
	 */
	public static function from_service( $service ) {
		$message = sprintf(
			'The service "%s" is not recognized and cannot be registered.',
			is_object( $service )
				? get_class( $service )
				: (string) $service
		);

		return new static( $message );
	}
}
