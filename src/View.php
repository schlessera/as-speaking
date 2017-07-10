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
 * Class View.
 *
 * Very basic View class to abstract away PHP view rendering.
 *
 * Note: This should normally be done through a dedicated package.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class View implements Renderable {

	/**
	 * Extension to use for view files.
	 *
	 * @since 0.1.0
	 */
	const VIEW_EXTENSION = 'php';

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
	 * URI to the view file to render.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $uri;

	/**
	 * Instantiate a View object.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri URI to the view file to render.
	 *
	 * @throws Exception\InvalidURI If an invalid URI was passed into the View.
	 */
	public function __construct( $uri ) {
		$this->uri = $this->validate( $uri );
	}

	/**
	 * Render a given URI.
	 *
	 * @since 0.1.0
	 *
	 * @param array $context Context in which to render.
	 *
	 * @return string Rendered HTML.
	 * @throws Exception\FailedToLoadView If the View URI could not be loaded.
	 */
	public function render( array $context = [] ) {

		// Add context to the current instance to make it available within the
		// rendered view.
		foreach ( $context as $key => $value ) {
			$this->$key = $value;
		}

		// Save current buffering level so we can backtrack in case of an error.
		// This is needed because the view itself might also add an unknown
		// number of output buffering levels.
		$buffer_level = ob_get_level();
		ob_start();

		try {
			include $this->uri;
		} catch ( \Exception $exception ) {
			// Remove whatever levels were added up until now.
			while ( ob_get_level() > $buffer_level ) {
				ob_end_clean();
			}
			throw Exception\FailedToLoadView::view_exception(
				$this->uri,
				$exception
			);
		}

		return ob_get_clean();
	}

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
		$uri = $this->check_extension( $uri );
		$uri = $this->make_absolute( $uri );

		if ( ! is_readable( $uri ) ) {
			throw Exception\InvalidURI::from_uri( $uri );
		}

		return $uri;
	}

	/**
	 * Check that the URI has the correct extension.
	 *
	 * Optionally adds the extension if none was detected.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri URI to check the extension of.
	 *
	 * @return string URI with correct extension.
	 */
	protected function check_extension( $uri ) {
		$extension = pathinfo( $uri, PATHINFO_EXTENSION );

		if ( static::VIEW_EXTENSION !== $extension ) {
			$uri .= '.' . static::VIEW_EXTENSION;
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
	 * @param string $uri URI to make absolute.
	 *
	 * @return string Absolute URI.
	 */
	protected function make_absolute( $uri ) {
		if ( ! $this->is_absolute_path( $uri ) ) {
			$uri = AS_SPEAKING_DIR . $uri;
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
	protected function is_absolute_path( $uri ) {
		return (bool) preg_match( static::ABSOLUTE_PATH_PATTERN, $uri );
	}
}
