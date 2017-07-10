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

namespace AlainSchlesser\Speaking;

/**
 * Class Plugin.
 *
 * Main plugin controller class that hooks the plugin's functionality into the
 * WordPress request lifecycle.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class Plugin {

	/**
	 * Register the plugin with the WordPress system.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		foreach ( $this->get_modules() as $module ) {
			if ( ! class_exists( $module ) ) {
				throw Exception\InvalidModule::from_module( $module );
			}
			( new $module )->register();
		}
	}

	/**
	 * Get the list of modules to register.
	 *
	 * @since 0.1.0
	 *
	 * @return array<string> Array of fully qualified class names.
	 */
	private function get_modules() {
		return [
			Shortcode\SpeakingPageBaseShortcode::class,
			CPT\TalkCustomPostType::class,
		];
	}
}
