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

use WP_Post;

/**
 * Class Talk.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class Talk {

	/**
	 * WordPress post data representing the talk.
	 *
	 * @since 0.1.0
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Instantiate a Talk object.
	 *
	 * @since 0.1.0
	 *
	 * @param WP_Post $post Post object to instantiate a Talk model from.
	 */
	public function __construct( WP_Post $post ) {
		$this->post = $post;
	}

	/**
	 * Get the talk's title.
	 *
	 * @since 0.1.0
	 *
	 * @return string Title of the talk.
	 */
	public function title() {
		return $this->post->post_title;
	}

	/**
	 * Get the talk's content.
	 *
	 * @since 0.1.0
	 *
	 * @return string Content of the talk.
	 */
	public function content() {
		return $this->post->post_content;
	}
}
