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

use AlainSchlesser\Speaking\Assets\StyleAsset;
use AlainSchlesser\Speaking\Model\TalkRepository;

/**
 * Class Talks.
 *
 * @since   0.2.4
 *
 * @package AlainSchlesser\Speaking\Widget
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class Talks extends BaseWidget {

	const ID                = 'as-speaking-talks-widget';
	const CLASS_NAME        = self::ID;
	const FRONTEND_VIEW_URI = 'views/talks-widget';
	const BACKEND_VIEW_URI  = 'views/talks-widget-form';

	const CSS_HANDLE = 'as-speaking-frontend-css';
	const CSS_URI    = 'assets/styles/as-speaking-frontend';

	const FIELD_TITLE      = 'title';
	const FIELD_TITLE_ID   = 'title_id';
	const FIELD_TITLE_NAME = 'title_name';

	/**
	 * Get the identifier of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string ID of the widget.
	 */
	protected function get_id() {
		return self::ID;
	}

	/**
	 * Get the title of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string Title of the widget.
	 */
	protected function get_title() {
		return esc_html__( 'Latest Talks', 'as-speaking' );
	}

	/**
	 * Get the view URI used to render the front-end version of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string URI of the frontend view.
	 */
	protected function get_frontend_view_uri() {
		return self::FRONTEND_VIEW_URI;
	}

	/**
	 * Get the view URI used to render the back-end version of the widget.
	 *
	 * @since 0.2.4
	 *
	 * @return string|false URI of the backend view, or false if none.
	 */
	protected function get_backend_view_uri() {
		return self::BACKEND_VIEW_URI;
	}

	/**
	 * Get the widget options.
	 *
	 * @since 0.2.4
	 *
	 * @return array Associative array of widget options.
	 */
	protected function get_widget_options() {
		return [
			'classname'   => self::CLASS_NAME,
			'description' => __(
				'List of the latest published talks.',
				'as-speaking'
			),
		];
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
		$talk_repository = new TalkRepository();

		return [
			'title' => isset( $instance[ self::FIELD_TITLE ] )
				? $instance[ self::FIELD_TITLE ]
				: esc_html__( 'My Talks', 'as-speaking' ),
			'talks' => $talk_repository->find_latest(),
		];
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
		return [
			self::FIELD_TITLE      => isset( $instance[ self::FIELD_TITLE ] )
				? $instance[ self::FIELD_TITLE ]
				: esc_html__( 'My Talks', 'as-speaking' ),
			self::FIELD_TITLE_ID   => $this->get_field_id( self::FIELD_TITLE ),
			self::FIELD_TITLE_NAME => $this->get_field_name( self::FIELD_TITLE ),
		];
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
		$sanitized = [];

		$sanitized[ self::FIELD_TITLE ] = isset( $instance[ self::FIELD_TITLE ] )
			? strip_tags( $instance[ self::FIELD_TITLE ] )
			: '';

		return $sanitized;
	}

	/**
	 * Get the array of known assets.
	 *
	 * @since 0.2.4
	 *
	 * @return array<Asset>
	 */
	protected function get_assets() {
		return is_admin()
			? []
			: [
				new StyleAsset(
					self::CSS_HANDLE,
					self::CSS_URI
				),
			];
	}
}
