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

namespace AlainSchlesser\Speaking\Model;

use AlainSchlesser\Speaking\CustomPostType\Talk as TalkCPT;
use AlainSchlesser\Speaking\Exception\InvalidPostID;
use WP_Query;

/**
 * Class TalkRepository.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class TalkRepository {

	/**
	 * Find the Talk with a given post ID.
	 *
	 * @since 0.1.0
	 *
	 * @param int $id Post ID to retrieve.
	 *
	 * @return Talk
	 */
	public function find( $id ) {
		$post = get_post( $id );
		if ( null === $post ) {
			throw InvalidPostID::from_id( $id );
		}

		return new Talk( $post );
	}

	/**
	 * Find all the published Talks.
	 *
	 * @since 0.1.0
	 *
	 * @return array<Talk>
	 */
	public function find_all() {
		$args  = [
			'post_type'      => TalkCPT::SLUG,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'meta_key'       => TalkMeta::META_PREFIX . 'session_date',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC',
		];
		$query = new WP_Query( $args );

		$talks = [];
		foreach ( $query->posts as $post ) {
			$talks[ $post->ID ] = new Talk( $post );
		}

		return $talks;
	}

	/**
	 * Persist a modified Talk to the storage.
	 *
	 * @since 0.1.0
	 *
	 * @param Talk $talk
	 */
	public function persist( Talk $talk ) {
		wp_insert_post( (array) $talk->get_post_object() );
		$talk->save_meta();
	}
}
