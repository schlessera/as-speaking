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

use AlainSchlesser\Speaking\CustomPostType\Talk as TalkCPT;

/**
 * Abstract class BaseMetabox.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class Talk extends BaseMetabox {

	const ID       = 'talk-cpt';
	const VIEW_URI = 'views/talk-metabox';

	/**
	 * Get the ID to use for the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string ID to use for the metabox.
	 */
	protected function get_id() {
		return self::ID;
	}

	/**
	 * Get the title to use for the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string Title to use for the metabox.
	 */
	protected function get_title() {
		return __( 'Talk properties', 'as-speaking' );
	}

	/**
	 * Get the screen on which to show the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string|array|\WP_Screen Screen on which to show the metabox.
	 */
	protected function get_screen() {
		return TalkCPT::SLUG;
	}

	/**
	 * Get the context in which to show the metabox.
	 *
	 * @since 0.1.0
	 *
	 * @return string Context to use.
	 */
	protected function get_context() {
		return static::CONTEXT_SIDE;
	}

	/**
	 * Get the priority within the context where the boxes should show.
	 *
	 * @since 0.1.0
	 *
	 * @return string Priority within context.
	 */
	protected function get_priority() {
		return static::PRIORITY_HIGH;
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
	protected function get_view_uri() {
		return self::VIEW_URI;
	}

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
	protected function process_attributes( $atts ) {
		return $atts;
	}
}
