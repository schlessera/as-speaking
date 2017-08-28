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
 * Abstract class CustomPostTypeEntity.
 *
 * @since   0.2.1
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class CustomPostTypeEntity implements Entity {

	/**
	 * WordPress post data representing the post.
	 *
	 * @since 0.2.1
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Instantiate a CustomPostTypeEntity object.
	 *
	 * @since 0.2.1
	 *
	 * @param WP_Post $post Post object to instantiate a CustomPostTypeEntity model from.
	 */
	public function __construct( WP_Post $post ) {
		$this->post = $post;
	}

	/**
	 * Return the entity ID.
	 *
	 * @since 0.2.1
	 *
	 * @return int Entity ID.
	 */
	public function get_ID() {
		return $this->post->ID;
	}

	/**
	 * Return the WP_Post object that represents this model.
	 *
	 * @since 0.2.1
	 *
	 * @return WP_Post WP_Post object representing this model.
	 */
	public function get_post_object() {
		return $this->post;
	}

	/**
	 * Get the post's title.
	 *
	 * @since 0.2.1
	 *
	 * @return string Title of the post.
	 */
	public function get_title() {
		return $this->post->post_title;
	}

	/**
	 * Set the post's title.
	 *
	 * @since 0.2.1
	 *
	 * @param string $title New title of the post.
	 */
	public function set_title( $title ) {
		$this->post->post_title = $title;
	}

	/**
	 * Get the post's content.
	 *
	 * @since 0.2.1
	 *
	 * @return string Content of the post.
	 */
	public function get_content() {
		return $this->post->post_content;
	}

	/**
	 * Set the post's content.
	 *
	 * @since 0.2.1
	 *
	 * @param string $content New content of the post.
	 */
	public function set_content( $content ) {
		$this->post->post_content = $content;
	}

	/**
	 * Magic getter method to fetch meta properties only when requested.
	 *
	 * @since 0.2.1
	 *
	 * @param string $property Property that was requested.
	 *
	 * @return mixed
	 */
	public function __get( $property ) {
		if ( array_key_exists( $property, $this->get_lazy_properties() ) ) {
			$this->load_lazy_property( $property );

			return $this->$property;
		}

		$message = sprintf(
			'Undefined property: %s::$%s',
			__CLASS__,
			$property
		);

		trigger_error( $message, E_USER_NOTICE );

		return null;
	}

	/**
	 * Persist the additional properties of the entity.
	 *
	 * @since 0.2.1
	 *
	 * @return void
	 */
	abstract public function persist_properties();

	/**
	 * Return the list of lazily-loaded properties and their default values.
	 *
	 * @since 0.2.1
	 *
	 * @return array
	 */
	abstract protected function get_lazy_properties();

	/**
	 * Load a lazily-loaded property.
	 *
	 * After this process, the loaded property should be set within the
	 * object's state, otherwise the load procedure might be triggered multiple
	 * times.
	 *
	 * @since 0.2.1
	 *
	 * @param string $property Name of the property to load.
	 *
	 * @return void
	 */
	abstract protected function load_lazy_property( $property );
}
