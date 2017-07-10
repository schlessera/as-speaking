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
 * Class FailedToLoadView.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Exception
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class FailedToLoadView extends \RuntimeException implements SpeakingPageException {

	/**
	 * Create a new instance of the exception if the view file itself created
	 * an exception.
	 *
	 * @since 0.1.0
	 *
	 * @param string     $uri       URI of the file that is not accessible or
	 *                              not readable.
	 * @param \Exception $exception Exception that was thrown by the view file.
	 *
	 * @return static
	 */
	public static function view_exception( $uri, $exception ) {
		$message = sprintf(
			'Could not load the View URI "%1$s". Reason: "%2$s".',
			$uri,
			$exception->getMessage()
		);

		return new static( $message, $exception->getCode(), $exception );
	}
}
