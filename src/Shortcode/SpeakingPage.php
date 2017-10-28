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

use AlainSchlesser\Speaking\Assets\StyleAsset;
use AlainSchlesser\Speaking\Model\Talk;
use AlainSchlesser\Speaking\Model\TalkRepository;
use DateTime;

/**
 * Class SpeakingPage.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class SpeakingPage extends BaseShortcode {

	const TAG      = 'speaking_page';
	const VIEW_URI = 'views/speaking-page';

	const CSS_HANDLE = 'as-speaking-frontend-css';
	const CSS_URI    = 'assets/styles/as-speaking-frontend';

	/**
	 * Get the tag to use for the shortcode.
	 *
	 * @since 0.1.0
	 */
	protected function get_tag() {
		return self::TAG;
	}

	/**
	 * Get the View URI to use for rendering the shortcode.
	 *
	 * @since 0.1.0
	 */
	protected function get_view_uri() {
		return self::VIEW_URI;
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
		$talk_repository = new TalkRepository();

		$talks = $talk_repository->find_all();

		return [
			'talks' => $this->sort_talks( $talks ),
		];
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
		];
	}

	/**
	 * Sort the array of talks for display.
	 *
	 * @since 0.2.12
	 *
	 * @param array <Talk> $talks Array of talks to sort.
	 *
	 * @return array<Talk> Sorted array of talks.
	 */
	protected function sort_talks( $talks ) {
		$now = ( new DateTime() )->getTimestamp();

		// We need a custom sort function to reverse the sort order for
		// upcoming talks (soonest first) as opposed to past talks.
		usort(
			$talks,
			function ( Talk $talk_a, Talk $talk_b ) use ( $now ) {
				$timestamp_a = $talk_a->get_session_date();
				$timestamp_b = $talk_b->get_session_date();

				if ( $timestamp_a >= $now ) {
					// A is upcoming.
					return $timestamp_b >= $now
						// B is also upcoming, ascend natural number.
						? strnatcmp( $timestamp_a, $timestamp_b )
						// B is past.
						: - 1;
				}

				// A is past.
				return $timestamp_b >= $now
					// B is upcoming.
					? 1
					// B is also past, descend on natural number.
					: strnatcmp( $timestamp_b, $timestamp_a );
			}
		);

		return $talks;
	}
}
