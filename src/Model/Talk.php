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
	 * Contains a map of custom (meta) properties and their corresponding
	 * sanitization filters..
	 */
	const SANITIZATION = [
		TalkMeta::EVENT_NAME   => FILTER_SANITIZE_STRING,
		TalkMeta::EVENT_LINK   => FILTER_SANITIZE_URL,
		TalkMeta::SESSION_DATE => FILTER_SANITIZE_NUMBER_INT,
		TalkMeta::SESSION_LINK => FILTER_SANITIZE_URL,
		TalkMeta::VIDEO        => FILTER_SANITIZE_URL,
		TalkMeta::SLIDES       => FILTER_SANITIZE_URL,
		TalkMeta::IMAGE_LINK   => FILTER_SANITIZE_STRING,
	];

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
	 * Return the post ID.
	 *
	 * @since 0.1.0
	 *
	 * @return int Post ID.
	 */
	public function get_ID() {
		return $this->post->ID;
	}

	/**
	 * Return the WP_Post object that represents this model.
	 *
	 * @since 0.1.0
	 *
	 * @return WP_Post WP_Post object representing this model.
	 */
	public function get_post_object() {
		return $this->post;
	}

	/**
	 * Get the talk's title.
	 *
	 * @since 0.1.0
	 *
	 * @return string Title of the talk.
	 */
	public function get_title() {
		return $this->post->post_title;
	}

	/**
	 * Set the talk's title.
	 *
	 * @since 0.1.0
	 *
	 * @param string $title New title of the talk.
	 */
	public function set_title( $title ) {
		$this->post->post_title = $title;
	}

	/**
	 * Get the talk's content.
	 *
	 * @since 0.1.0
	 *
	 * @return string Content of the talk.
	 */
	public function get_content() {
		return $this->post->post_content;
	}

	/**
	 * Set the talk's content.
	 *
	 * @since 0.1.0
	 *
	 * @param string $content New content of the talk.
	 */
	public function set_content( $content ) {
		$this->post->post_content = $content;
	}

	/**
	 * Get the name of the event.
	 *
	 * @since 0.1.0
	 *
	 * @return string Name of the event.
	 */
	public function get_event_name() {
		return $this->event_name;
	}

	/**
	 * Set the name of the event.
	 *
	 * @since 0.1.0
	 *
	 * @param string $event_name New name of the event.
	 */
	public function set_event_name( $event_name ) {
		$this->event_name = filter_var(
			$event_name,
			static::SANITIZATION[ TalkMeta::EVENT_NAME ]
		);
	}

	/**
	 * Get the URI the event links to.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI the event links to.
	 */
	public function get_event_link() {
		return $this->event_link;
	}

	/**
	 * Set the URI the event links to.
	 *
	 * @since 0.1.0
	 *
	 * @param string $event_link New URI the event links to.
	 */
	public function set_event_link( $event_link ) {
		$this->event_link = filter_var(
			$event_link,
			static::SANITIZATION[ TalkMeta::EVENT_LINK ]
		);
	}

	/**
	 * Get the date of the session.
	 *
	 * @since 0.1.0
	 *
	 * @return string Date of the session.
	 */
	public function get_session_date() {
		return $this->session_date;
	}

	/**
	 * Set the date of the session.
	 *
	 * @since 0.1.0
	 *
	 * @param string $session_date New date of the session.
	 */
	public function set_session_date( $session_date ) {
		$this->session_date = filter_var(
			$session_date,
			static::SANITIZATION[ TalkMeta::SESSION_DATE ]
		);
	}

	/**
	 * Get the URI the session links to.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI the session links to.
	 */
	public function get_session_link() {
		return $this->session_link;
	}

	/**
	 * Set the URI the session links to.
	 *
	 * @since 0.1.0
	 *
	 * @param string $session_link New URI the session links to.
	 */
	public function set_session_link( $session_link ) {
		$this->session_link = filter_var(
			$session_link,
			static::SANITIZATION[ TalkMeta::SESSION_LINK ]
		);
	}

	/**
	 * Get the URI of the video.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI of the video.
	 */
	public function get_video() {
		return $this->video;
	}

	/**
	 * Set the URI of the video.
	 *
	 * @since 0.1.0
	 *
	 * @param string $video New URI of the video.
	 */
	public function set_video( $video ) {
		$this->video = filter_var(
			$video,
			static::SANITIZATION[ TalkMeta::VIDEO ]
		);
	}

	/**
	 * Get the URI of the slides.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI of the slides.
	 */
	public function get_slides() {
		return $this->slides;
	}

	/**
	 * Set the URI of the slides.
	 *
	 * @since 0.1.0
	 *
	 * @param string $slides New URI of the slides.
	 */
	public function set_slides( $slides ) {
		$this->slides = filter_var(
			$slides,
			static::SANITIZATION[ TalkMeta::SLIDES ]
		);
	}

	/**
	 * Get the element the featured image links to.
	 *
	 * @since 0.1.0
	 *
	 * @return string Element the featured image links to.
	 */
	public function get_image_link() {
		return $this->image_link;
	}

	/**
	 * Set the element the featured image links to.
	 *
	 * @since 0.1.0
	 *
	 * @param string $image_link New element the featured image links to.
	 */
	public function set_image_link( $image_link ) {
		$this->image_link = filter_var(
			$image_link,
			static::SANITIZATION[ TalkMeta::IMAGE_LINK ]
		);
	}

	/**
	 * Get the featured image.
	 *
	 * Depending on the $image_link setting, it might be wrapped in a link.
	 *
	 * @since 0.1.0
	 *
	 * @param string|null $size Optional. Size to create the featured image in.
	 *
	 * @return string Rendered featured image HTML.
	 */
	public function get_featured_image( $size = null ) {
		$image = get_the_post_thumbnail( $this->post->ID, $size );

		if ( empty( $image ) ) {
			return '';
		}

		switch ( $this->image_link ) {
			case TalkMeta::IMAGE_LINK_EVENT:
				$image = "<a href=\"{$this->event_link}\">{$image}</a>";
				break;
			case TalkMeta::IMAGE_LINK_SESSION:
				$image = "<a href=\"{$this->session_link}\">{$image}</a>";
				break;
			case TalkMeta::IMAGE_LINK_VIDEO:
				$image = "<a href=\"{$this->video}\">{$image}</a>";
				break;
			case TalkMeta::IMAGE_LINK_SLIDES:
				$image = "<a href=\"{$this->slides}\">{$image}</a>";
				break;
			default:
				break;
		}

		return $image;
	}

	/**
	 * Parse the data from the superglobal $_POST.
	 *
	 * @since 0.1.0
	 *
	 * @param array $post $_POST superglobal.
	 */
	public function parse_post_data( array $post ) {
		foreach ( $this->get_meta_properties() as $key => $default ) {
			$this->$key = filter_var(
				$post[ TalkMeta::FORM_FIELD_PREFIX . $key ],
				array_key_exists( $key, static::SANITIZATION )
					? static::SANITIZATION[ $key ]
					: FILTER_SANITIZE_STRING
			);
		}

		$aa = filter_var(
			$post[ TalkMeta::FORM_FIELD_SESSION_AA ],
			FILTER_SANITIZE_NUMBER_INT
		);

		$mm = filter_var(
			$post[ TalkMeta::FORM_FIELD_SESSION_MM ],
			FILTER_SANITIZE_NUMBER_INT
		);

		$jj = filter_var(
			$post[ TalkMeta::FORM_FIELD_SESSION_JJ ],
			FILTER_SANITIZE_NUMBER_INT
		);

		$date = new \DateTimeImmutable( "$aa-$mm-$jj" );
		$this->set_session_date( $date->getTimestamp() );
	}

	/**
	 * Return the list of meta properties and their default values.
	 *
	 * @since 0.1.0
	 *
	 * @return array
	 */
	protected function get_meta_properties() {
		return [
			TalkMeta::EVENT_NAME   => '',
			TalkMeta::EVENT_LINK   => '',
			TalkMeta::SESSION_DATE => '',
			TalkMeta::SESSION_LINK => '',
			TalkMeta::VIDEO        => '',
			TalkMeta::SLIDES       => '',
			TalkMeta::IMAGE_LINK   => TalkMeta::IMAGE_LINK_VIDEO,
		];
	}

	/**
	 * Load the meta data of the model.
	 *
	 * @since 0.1.0
	 *
	 */
	protected function load_meta() {
		$meta = get_post_meta( $this->post->ID );

		foreach ( $this->get_meta_properties() as $key => $default ) {
			$this->$key = array_key_exists( TalkMeta::META_PREFIX . $key,
				$meta )
				? $meta[ TalkMeta::META_PREFIX . $key ][0]
				: $default;
		}
	}

	/**
	 * Save the meta data of the model.
	 *
	 * @since 0.1.0
	 */
	public function save_meta() {
		foreach ( $this->get_meta_properties() as $key => $default ) {
			if ( $this->$key === $default ) {
				delete_post_meta( $this->post->ID,
					TalkMeta::META_PREFIX . $key );
				continue;
			}

			update_post_meta(
				$this->post->ID,
				TalkMeta::META_PREFIX . $key,
				$this->$key
			);
		}
	}

	/**
	 * Magic getter method to fetch meta properties only when requested.
	 *
	 * @since 0.2.0
	 *
	 * @param string $property Property that was requested.
	 *
	 * @return mixed
	 */
	public function __get( $property ) {
		if ( in_array( $property, TalkMeta::PROPERTIES, $strict = true ) ) {
			$this->load_meta();

			return $this->$property;
		}

		$message = sprintf(
			'Undefined property: %s::$%s',
			get_class(),
			$property
		);

		trigger_error( $message, E_USER_NOTICE );

		return null;
	}
}
