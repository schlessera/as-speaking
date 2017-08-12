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

use AlainSchlesser\Speaking\Assets\ScriptAsset;
use AlainSchlesser\Speaking\Assets\StyleAsset;
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

	const CSS_HANDLE = 'as-speaking-backend-css';
	const CSS_URI    = 'assets/styles/as-speaking-backend';

	const JS_HANDLE = 'as-speaking-backend-js';
	const JS_URI    = 'assets/scripts/as-speaking-backend';

	const IMAGE_LINK_NOTHING = 'nothing';
	const IMAGE_LINK_EVENT   = 'event';
	const IMAGE_LINK_SESSION = 'session';
	const IMAGE_LINK_VIDEO   = 'video';
	const IMAGE_LINK_SLIDES  = 'slides';

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
	 * Get the array of known assets.
	 *
	 * @since 0.1.0
	 *
	 * @return array<Asset>
	 */
	protected function get_assets() {
		return [
			new StyleAsset(
				self::CSS_HANDLE,
				self::CSS_URI
			),
			new ScriptAsset(
				self::JS_HANDLE,
				self::JS_URI,
				[ 'jquery' ],
				$version = false,
				ScriptAsset::ENQUEUE_FOOTER
			),
		];
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
		$atts = (array) $atts;
		$atts['event_name'] = 'WordCamp Europe 2017';
		$atts['event_link'] = '';
		$atts['session_date'] = '16.06.2017';
		$atts['session_link'] = '';
		$atts['video'] = 'https://wordpress.tv/2017/06/22/alain-schlesser-demystifying-the-wordpress-bootstrap-process/';
		$atts['slides'] = 'https://schlessera.github.io/wceu-2017/';
		$atts['image_link'] = self::IMAGE_LINK_VIDEO;

		return $atts;
	}
}
