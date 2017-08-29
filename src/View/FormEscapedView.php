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
 * Class FormEscapedView.
 *
 * This is a Decorator that decorates a given View with escaping meant for
 * HTML form output.
 *
 * @since   0.2.4
 *
 * @package AlainSchlesser\Speaking\View
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class FormEscapedView implements View {

	/**
	 * View instance to decorate.
	 *
	 * @since 0.2.4
	 *
	 * @var View
	 */
	private $view;

	/**
	 * Tags that are allowed to pass through the escaping function.
	 *
	 * @since 0.2.3
	 *
	 * @var array
	 */
	private $allowed_tags = [];

	/**
	 * Instantiate a FormEscapedView object.
	 *
	 * @since 0.2.4
	 *
	 * @param View       $view         View instance to decorate.
	 * @param array|null $allowed_tags Optional. Array of allowed tags to let
	 *                                 through escaping functions. Set to sane
	 *                                 defaults if none provided.
	 */
	public function __construct( View $view, $allowed_tags = null ) {
		$this->view         = $view;
		$this->allowed_tags = null === $allowed_tags
			? $this->prepare_allowed_tags( wp_kses_allowed_html( 'post' ) )
			: $allowed_tags;
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
		return wp_kses( $this->view->render( $context ), $this->allowed_tags );
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
		return wp_kses(
			$this->view->render_partial( $uri, $context ),
			$this->allowed_tags
		);
	}

	/**
	 * Prepare an array of allowed tags by adding form elements to the existing
	 * array.
	 *
	 * This makes sure that the basic form elements always pass through the
	 * escaping functions.
	 *
	 * @since 0.2.4
	 *
	 * @param array $allowed_tags Allowed tags as fetched from the WordPress
	 *                            defaults.
	 *
	 * @return array Modified tags array.
	 */
	private function prepare_allowed_tags( $allowed_tags ) {
		$form_tags = [
			'form'   => [
				'id'     => true,
				'class'  => true,
				'action' => true,
				'method' => true,
			],
			'input'  => [
				'id'    => true,
				'class' => true,
				'type'  => true,
				'name'  => true,
				'value' => true,
			],
			'select' => [
				'id'    => true,
				'class' => true,
				'type'  => true,
				'name'  => true,
				'value' => true,
			],
			'option' => [
				'id'       => true,
				'class'    => true,
				'type'     => true,
				'name'     => true,
				'value'    => true,
				'selected' => true,
			],
			'label'  => [
				'for' => true,
			],
		];

		return array_replace_recursive( $allowed_tags, $form_tags );
	}
}
