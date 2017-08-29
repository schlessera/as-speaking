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

namespace AlainSchlesser\Speaking\Widget;

use AlainSchlesser\Speaking\Assets\AssetsAware;
use AlainSchlesser\Speaking\Assets\AssetsAwareness;
use AlainSchlesser\Speaking\Renderable;
use AlainSchlesser\Speaking\Service;
use AlainSchlesser\Speaking\View\FormEscapedView;
use AlainSchlesser\Speaking\View\PostEscapedView;
use AlainSchlesser\Speaking\View\TemplatedView;
use WP_Widget;

/**
 * Abstract class BaseWidget.
 *
 * @since   0.2.4
 *
 * @package AlainSchlesser\Speaking\Widget
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class BaseWidget extends WP_Widget implements AssetsAware, Renderable, Service {

	use AssetsAwareness;

	/**
	 * Instantiate a BaseWidget object.
	 *
	 * @since 0.2.4
	 */
	public function __construct() {
		parent::__construct(
			$this->get_id(),
			$this->get_title(),
			$this->get_widget_options(),
			$this->get_control_options()
		);
	}

	/**
	 * Register the current Registerable.
	 *
	 * @since 0.2.4
	 *
	 * @return void
	 */
	public function register() {
		$this->register_assets();

		add_action( 'widgets_init', function () {
			register_widget( $this );
		} );
	}

	/**
	 * Render the current Renderable.
	 *
	 * @since 0.2.4
	 *
	 * @param array $context Context in which to render.
	 *
	 * @return string Rendered HTML.
	 */
	public function render( array $context = [] ) {
		try {
			$this->enqueue_assets();

			$view = new PostEscapedView(
				new TemplatedView( $this->get_frontend_view_uri() )
			);

			return $view->render( $context );
		} catch ( \Exception $exception ) {
			// Don't let exceptions bubble up. Just render an empty shortcode
			// instead.
			return '';
		}
	}

	/**
	 * Frontend display of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @param array $args     Arguments passed onto the widget.
	 * @param array $instance Instance to render.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$args    = $this->process_arguments( $args );
		$context = $this->get_frontend_context( $instance, $args );

		echo $this->render( array_merge( $args, $context ) );
	}

	/**
	 * Render the backend widget form.
	 *
	 * @since 0.2.4
	 *
	 * @param array $instance Saved values from the database.
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$uri = $this->get_backend_view_uri();

		if ( ! $uri ) {
			parent::form( $instance );
		}

		try {
			$this->enqueue_assets();

			$view = new FormEscapedView(
				new TemplatedView( $uri )
			);

			$context = $this->get_backend_context( $instance );

			echo $view->render( $context );
		} catch ( \Exception $exception ) {
			// Don't let exceptions bubble up. Just render an empty shortcode
			// instead.
		}
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * This function should check that `$new_instance` is set correctly. The
	 * newly-calculated value of `$instance` should be returned. If false is
	 * returned, the instance won't be saved/updated.
	 *
	 * @since  0.2.4
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by
	 *                            the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		return $this->sanitize_instance( $new_instance );
	}

	/**
	 * Process the widget arguments.
	 *
	 * Override to add accepted arguments and their default values.
	 *
	 * @since 0.2.4
	 *
	 * @param array|string $args Raw widget arguments passed into the widget
	 *                           function.
	 *
	 * @return array Processed shortcode arguments.
	 */
	protected function process_arguments( $args ) {
		return wp_parse_args(
			$args,
			$this->get_default_arguments()
		);
	}

	/**
	 * Get the context to pass onto the front-end view.
	 *
	 * Override to provide data to the view that is not part of the widget
	 * arguments.
	 *
	 * @since 0.2.4
	 *
	 * @param array $instance Saved values from the database.
	 * @param array $args     Array of widget arguments.
	 *
	 * @return array Context to pass onto view.
	 */
	protected function get_frontend_context( $instance, $args ) {
		return [];
	}

	/**
	 * Get the context to pass onto the back-end view.
	 *
	 * Override to provide data to the view that is not part of the widget
	 * arguments.
	 *
	 * @since 0.2.4
	 *
	 * @param array $instance Saved values from the database.
	 *
	 * @return array Context to pass onto view.
	 */
	protected function get_backend_context( $instance ) {
		return [];
	}

	/**
	 * Associative array of default arguments.
	 *
	 * @since 0.2.4
	 *
	 * @return array Default arguments.
	 */
	protected function get_default_arguments() {
		return [];
	}

	/**
	 * Get the widget options.
	 *
	 * @since 0.2.4
	 *
	 * @return array Associative array of widget options.
	 */
	protected function get_widget_options() {
		return [];
	}

	/**
	 * Get the control options for the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return array Associative array of control options.
	 */
	protected function get_control_options() {
		return [];
	}

	/**
	 * Get the view URI used to render the back-end version of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string|false URI of the backend view, or false if none.
	 */
	protected function get_backend_view_uri() {
		return false;
	}

	/**
	 * Sanitize a set of instance values.
	 *
	 * @since 0.2.4
	 *
	 * @param array $instance Set of instance values to sanitize.
	 *
	 * @return array Sanitized instance values.
	 */
	protected function sanitize_instance( $instance ) {
		return $instance;
	}

	/**
	 * Get the identifier of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string ID of the widget.
	 */
	abstract protected function get_id();

	/**
	 * Get the title of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string Title of the widget.
	 */
	abstract protected function get_title();

	/**
	 * Get the view URI used to render the front-end version of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string URI of the frontend view.
	 */
	abstract protected function get_frontend_view_uri();
}
