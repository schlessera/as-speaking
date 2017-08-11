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

namespace AlainSchlesser\Speaking\Shortcode;

use AlainSchlesser\Speaking\Registerable;
use AlainSchlesser\Speaking\Renderable;
use AlainSchlesser\Speaking\View;

/**
 * Abstract class BaseShortcode.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class BaseShortcode implements Renderable, Registerable {

	/**
	 * Register the Shortcode.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_action( 'init', function () {
			add_shortcode( $this->get_tag(), [ $this, 'process_shortcode' ] );
		} );
	}

	/**
	 * Process the shortcode attributes and prepare rendering.
	 *
	 * @since 0.1.0
	 *
	 * @param array|string $atts Attributes as passed to the shortcode.
	 *
	 * @return string Rendered HTML of the shortcode.
	 */
	public function process_shortcode( $atts ) {
		$atts    = $this->process_attributes( $atts );
		$context = $this->get_context( $atts );

		return $this->render( array_merge( $atts, $context ) );
	}

	/**
	 * Render the current Renderable.
	 *
	 * @since 0.1.0
	 *
	 * @param array $context Context in which to render.
	 *
	 * @return string Rendered HTML.
	 */
	public function render( array $context = [] ) {
		try {
			$view = new View( $this->get_view_uri() );

			return $view->render( $context );
		} catch ( \Exception $exception ) {
			// Don't let exceptions bubble up. Just render an empty shortcode
			// instead.
			return '';
		}
	}

	/**
	 * Process the shortcode attributes.
	 *
	 * Override to add accepted attributes and their default values.
	 *
	 * @since 0.1.0
	 *
	 * @param array|string $atts Raw shortcode attributes passed into the
	 *                           shortcode function.
	 *
	 * @return array Processed shortcode attributes.
	 */
	protected function process_attributes( $atts ) {
		return shortcode_atts(
			[
				// Shortcode attributes' default values.
			],
			$atts,
			$this->get_tag()
		);
	}

	/**
	 * Get the context to pass onto the view.
	 *
	 * Override to provide data to the view that is not part of the shortcode
	 * attributes.
	 *
	 * @since 0.1.0
	 *
	 * @param array $atts Array of shortcode attributes.
	 *
	 * @return array Context to pass onto view.
	 */
	protected function get_context( $atts ) {
		return [];
	}

	/**
	 * Get the tag to use for the shortcode.
	 *
	 * @since 0.1.0
	 *
	 * @return string Tag of the shortcode.
	 */
	abstract protected function get_tag();

	/**
	 * Get the View URI to use for rendering the shortcode.
	 *
	 * @since 0.1.0
	 *
	 * @return string View URI.
	 */
	abstract protected function get_view_uri();
}
