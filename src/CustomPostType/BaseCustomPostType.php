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

namespace AlainSchlesser\Speaking\CustomPostType;

use AlainSchlesser\Speaking\Service;

/**
 * Abstract class BaseCustomPostType.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class BaseCustomPostType implements Service {

	/**
	 * Register the custom post type.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_action( 'init', function () {
			register_post_type( $this->get_slug(), $this->get_arguments() );
		} );
	}

	/**
	 * Get the slug to use for the custom post type.
	 *
	 * @since 0.1.0
	 *
	 * @return string Custom post type slug.
	 */
	abstract protected function get_slug();

	/**
	 * Get the arguments that configure the custom post type.
	 *
	 * @since 0.1.0
	 *
	 * @return array Array of arguments.
	 */
	abstract protected function get_arguments();
}
