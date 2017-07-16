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
final class Plugin implements Registerable {

	/**
	 * Register the plugin with the WordPress system.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_action( 'plugins_loaded', [ $this, 'register_modules' ] );
	}

	/**
	 * Register the individual modules of this plugin.
	 *
	 * @since 0.1.0
	 */
	public function register_modules() {
		$modules = $this->get_modules();
		$modules = array_map( [ $this, 'instantiate_module' ], $modules );
		array_walk( $modules, function( Registerable $module ) {
			$module->register();
		} );
	}

	/**
	 * Instantiate a single module.
	 *
	 * @since 0.1.0
	 *
	 * @param string $class Module class to instantiate.
	 *
	 * @return object
	 */
	private function instantiate_module( $class ) {
		if ( ! class_exists( $class ) ) {
			throw Exception\InvalidModule::from_module( $class );
		}

		$module = new $class();

		if ( ! $module instanceof Registerable ) {
			throw Exception\InvalidModule::from_module( $module );
		}

		return $module;
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
			Shortcode\SpeakingPage::class,
			CustomPostType\Talk::class,
		];
	}
}
