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
 * Class InvalidModule.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class InvalidModule extends \InvalidArgumentException implements SpeakingPageException {

	/**
	 * Create a new instance of the exception for a module class name that is
	 * not recognized.
	 *
	 * @since 0.1.0
	 *
	 * @param string $module Class name of the module that was not recognized.
	 *
	 * @return static
	 */
	public static function from_module( $module ) {
		$message = sprintf(
			'The module "%s" is not recognized and cannot be registered.',
			is_object( $module )
				? get_class( $module )
				: (string) $module
		);

		return new static( $message );
	}
}
