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

	const IMAGE_LINK_NOTHING = 'nothing';
	const IMAGE_LINK_EVENT   = 'event';
	const IMAGE_LINK_SESSION = 'session';
	const IMAGE_LINK_VIDEO   = 'video';
	const IMAGE_LINK_SLIDES  = 'slides';

	const FORM_FIELD_PREFIX = 'talk_cpt_';
	const META_PREFIX       = 'talk_cpt_meta_';

	/**
	 * WordPress post data representing the talk.
	 *
	 * @since 0.1.0
	 *
	 * @var WP_Post
	 */
	protected $post;

	/**
	 * Event name.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $event_name;

	/**
	 * URI the event links to.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $event_link;

	/**
	 * Session date.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $session_date;

	/**
	 * URI the session links to.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $session_link;

	/**
	 * URI of the video recording.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $video;

	/**
	 * URI of the slides.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $slides;

	/**
	 * Element the feature image links to.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $image_link;

	/**
	 * Whether the meta data has already been loaded.
	 *
	 * @since 0.1.0
	 *
	 * @var bool
	 */
	protected $is_meta_loaded = false;

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
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->event_name = $event_name;
	}

	/**
	 * Get the URI the event links to.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI the event links to.
	 */
	public function get_event_link() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->event_link = $event_link;
	}

	/**
	 * Get the date of the session.
	 *
	 * @since 0.1.0
	 *
	 * @return string Date of the session.
	 */
	public function get_session_date() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->session_date = $session_date;
	}

	/**
	 * Get the URI the session links to.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI the session links to.
	 */
	public function get_session_link() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->session_link = $session_link;
	}

	/**
	 * Get the URI of the video.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI of the video.
	 */
	public function get_video() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->video = $video;
	}

	/**
	 * Get the URI of the slides.
	 *
	 * @since 0.1.0
	 *
	 * @return string URI of the slides.
	 */
	public function get_slides() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->slides = $slides;
	}

	/**
	 * Get the element the featured image links to.
	 *
	 * @since 0.1.0
	 *
	 * @return string Element the featured image links to.
	 */
	public function get_image_link() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

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
		$this->image_link = $image_link;
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
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

		$image = get_the_post_thumbnail( $this->post->ID, $size );

		if ( empty( $image ) ) {
			return '';
		}

		switch ( $this->image_link ) {
			case static::IMAGE_LINK_EVENT:
				$image = "<a href=\"{$this->event_link}\">{$image}</a>";
				break;
			case static::IMAGE_LINK_SESSION:
				$image = "<a href=\"{$this->session_link}\">{$image}</a>";
				break;
			case static::IMAGE_LINK_VIDEO:
				$image = "<a href=\"{$this->video}\">{$image}</a>";
				break;
			case static::IMAGE_LINK_SLIDES:
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
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

		foreach ( $this->get_meta_properties() as $key => $default ) {
			$this->$key = sanitize_text_field( $post[ static::FORM_FIELD_PREFIX . $key ] );
		}

		$aa = sanitize_text_field( $post[ static::FORM_FIELD_PREFIX . 'session_aa' ] );
		$mm = sanitize_text_field( $post[ static::FORM_FIELD_PREFIX . 'session_mm' ] );
		$jj = sanitize_text_field( $post[ static::FORM_FIELD_PREFIX . 'session_jj' ] );

		$date = new \DateTimeImmutable("$aa-$mm-$jj" );
		$this->session_date = $date->getTimestamp();
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
			'event_name'   => '',
			'event_link'   => '',
			'session_date' => '',
			'session_link' => '',
			'video'        => '',
			'slides'       => '',
			'image_link'   => 'video',
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
			$this->$key = array_key_exists( static::META_PREFIX . $key, $meta )
				? $meta[ static::META_PREFIX . $key ][0]
				: $default;
		}

		$this->is_meta_loaded = true;
	}

	/**
	 * Save the meta data of the model.
	 *
	 * @since 0.1.0
	 */
	public function save_meta() {
		if ( ! $this->is_meta_loaded ) {
			$this->load_meta();
		}

		foreach ( $this->get_meta_properties() as $key => $default ) {
			if ( $this->$key === $default ) {
				delete_post_meta( $this->post->ID, static::META_PREFIX . $key );
				continue;
			}

			update_post_meta(
				$this->post->ID,
				static::META_PREFIX . $key,
				$this->$key
			);
		}
	}
}
