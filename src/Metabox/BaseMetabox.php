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

namespace AlainSchlesser\Speaking\Metabox;

use AlainSchlesser\Speaking\Assets\AssetsAware;
use AlainSchlesser\Speaking\Assets\AssetsAwareTrait;
use AlainSchlesser\Speaking\Renderable;
use AlainSchlesser\Speaking\Service;
use AlainSchlesser\Speaking\View;

/**
 * Abstract class BaseMetabox.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class BaseMetabox implements Renderable, Service, AssetsAware {

	use AssetsAwareTrait;

	const CONTEXT_ADVANCED = 'advanced';
	const CONTEXT_NORMAL   = 'normal';
	const CONTEXT_SIDE     = 'side';

	const PRIORITY_DEFAULT = 'default';
	const PRIORITY_HIGH    = 'high';
	const PRIORITY_LOW     = 'low';

	/**
	 * Register the Metabox.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		$this->register_assets();

		add_action( 'init', function () {
			add_meta_box(
				$this->get_id(),
				$this->get_title(),
				[ $this, 'process_metabox' ],
				$this->get_screen(),
				$this->get_context(),
				$this->get_priority(),
				$this->get_callback_args()
			);
		} );
	}

	/**
	 * Process the metabox attributes and prepare rendering.
	 *
	 * @since 0.1.0
	 *
	 * @param array|string $atts Attributes as passed to the metabox.
	 *
	 * @return string Rendered HTML of the metabox.
	 */
	public function process_metabox( $atts ) {
		$atts = $this->process_attributes( $atts );

		echo $this->render( (array) $atts );
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
			$this->enqueue_assets();

			$view = new View( $this->get_view_uri() );

			return $view->render( $context );
		} catch ( \Exception $exception ) {
			// Don't let exceptions bubble up. Just render the exception message
			// into the metabox.
			return sprintf(
				'<pre>%s</pre>',
				$exception->getMessage()
			);
		}
	}

	/**
	 * Get the ID to use for the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string ID to use for the metabox.
	 */
	abstract protected function get_id();

	/**
	 * Get the title to use for the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string Title to use for the metabox.
	 */
	abstract protected function get_title();

	/**
	 * Get the screen on which to show the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string|array|\WP_Screen Screen on which to show the metabox.
	 */
	protected function get_screen() {
		return null;
	}

	/**
	 * Get the context in which to show the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string Context to use.
	 */
	protected function get_context() {
		return static::CONTEXT_ADVANCED;
	}

	/**
	 * Get the priority within the context where the boxes should show.
	 *
	 * @since 0.1.0
	 *
	 * @return string Priority within context.
	 */
	protected function get_priority() {
		return static::PRIORITY_DEFAULT;
	}

	/**
	 * Get the array of arguments to pass to the render callback.
	 *
	 * @since 0.1.0
	 *
	 * @return array Array of arguments.
	 */
	protected function get_callback_args() {
		return [];
	}

	/**
	 * Get the View URI to use for rendering the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string View URI.
	 */
	abstract protected function get_view_uri();

	/**
	 * Process the metabox attributes.
	 *
	 * @since 0.1.0
	 *
	 * @param array|string $atts Raw metabox attributes passed into the
	 *                           metabox function.
	 *
	 * @return array Processed metabox attributes.
	 */
	abstract protected function process_attributes( $atts );
}
