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

namespace AlainSchlesser\Speaking\View;

use AlainSchlesser\Speaking\Exception\FailedToLoadView;
use AlainSchlesser\Speaking\Exception\InvalidURI;

/**
 * Class PostEscapedView.
 *
 * This is a Decorator that decorates a given View with escaping meant for
 * standard HTML post output.
 *
 * @since   0.2.4
 *
 * @package AlainSchlesser\Speaking\View
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class PostEscapedView implements View {

	/**
	 * View instance to decorate.
	 *
	 * @since 0.2.4
	 *
	 * @var View
	 */
	private $view;

	/**
	 * Instantiate a PostEscapedView object.
	 *
	 * @since 0.2.4
	 *
	 * @param View $view View instance to decorate.
	 */
	public function __construct( View $view ) {
		$this->view = $view;
	}

	/**
	 * Render a given URI.
	 *
	 * @since 0.2.4
	 *
	 * @param array $context Context in which to render.
	 *
	 * @return string Rendered HTML.
	 * @throws FailedToLoadView If the View URI could not be loaded.
	 */
	public function render( array $context = [] ) {
		return wp_kses_post( $this->view->render( $context ) );
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
	 * @since 0.2.4
	 *
	 * @param string     $uri     URI of the partial to render.
	 * @param array|null $context Context in which to render the partial.
	 *
	 * @return string Rendered HTML.
	 * @throws InvalidURI If the provided URI was not valid.
	 * @throws FailedToLoadView If the view could not be loaded.
	 */
	public function render_partial( $uri, array $context = null ) {
		return wp_kses_post( $this->view->render_partial( $uri, $context ) );
	}
}
