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

use AlainSchlesser\Speaking\Exception\FailedToLoadView;
use AlainSchlesser\Speaking\Exception\InvalidURI;

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
	 * URI to the view file to render.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $uri;

	/**
	 * Internal storage for passed-in context.
	 *
	 * @since 0.1.0
	 *
	 * @var array
	 */
	protected $_context_ = [];

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

		// Add entire context as array to the current instance to pass onto
		// partial views.
		$this->_context_ = $context;

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
	 * Render a partial view.
	 *
	 * This can be used from within a currently rendered view, to include
	 * nested partials.
	 *
	 * The passed-in context is optional, and will fall back to the parent's
	 * context if omitted.
	 *
	 * @since 0.1.0
	 *
	 * @param            $uri
	 * @param array|null $context
	 *
	 * @return string
	 * @throws InvalidURI If the provided URI was not valid.
	 * @throws FailedToLoadView If the view could not be loaded.
	 */
	public function render_partial( $uri, array $context = null ) {
		$view = new View( $uri );

		return $view->render( $context ?: $this->_context_ );
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
		$uri = PathHelper::check_extension( $uri, static::VIEW_EXTENSION );
		$uri = PathHelper::make_absolute( $uri, AS_SPEAKING_DIR );

		if ( ! is_readable( $uri ) ) {
			throw Exception\InvalidURI::from_uri( $uri );
		}

		return $uri;
	}
}
