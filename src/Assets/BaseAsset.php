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

namespace AlainSchlesser\Speaking\Assets;

use AlainSchlesser\Speaking\PathHelper;
use Closure;

/**
 * Abstract class BaseAsset.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Assets
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class BaseAsset implements Asset {

	const REGISTER_PRIORITY = 1;
	const ENQUEUE_PRIORITY  = 10;

	/**
	 * Handle of the asset.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $handle;

	/**
	 * Get the handle of the asset.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function get_handle() {
		return $this->handle;
	}

	/**
	 * Render the current Registerable.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function register() {
		$this->deferred_action(
			$this->get_register_action(),
			$this->get_register_closure(),
			static::REGISTER_PRIORITY
		);
	}

	/**
	 * Enqueue the asset.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function enqueue() {
		$this->deferred_action(
			$this->get_enqueue_action(),
			$this->get_enqueue_closure(),
			static::ENQUEUE_PRIORITY
		);
	}

	/**
	 * Add a deferred action hook.
	 *
	 * If the action has already passed, the closure will be called directly.
	 *
	 * @since 0.1.0
	 *
	 * @param string  $action   Deferred action to hook to.
	 * @param Closure $closure  Closure to attach to the action.
	 * @param int     $priority Optional. Priority to use. Defaults to 10.
	 */
	protected function deferred_action( $action, $closure, $priority = 10 ) {
		if ( did_action( $action ) ) {
			$closure();

			return;
		}

		add_action(
			$action,
			$closure,
			$priority
		);
	}

	/**
	 * Get the register action to use.
	 *
	 * @since 0.1.0
	 *
	 * @return string Register action to use.
	 */
	protected function get_register_action() {
		return $this->get_enqueue_action();
	}

	/**
	 * Get the enqueue action to use.
	 *
	 * @since 0.1.0
	 *
	 * @return string Enqueue action name.
	 */
	protected function get_enqueue_action() {
		return is_admin() ? 'admin_enqueue_scripts' : 'wp_enqueue_scripts';
	}

	/**
	 * Normalize the source URI.
	 *
	 * @since 0.1.0
	 *
	 * @param string $uri       Source URI to normalize.
	 * @param string $extension Default extension to use.
	 *
	 * @return string Normalized source URI.
	 */
	protected function normalize_source( $uri, $extension ) {
		$uri = PathHelper::check_extension( $uri, $extension );
		$uri = PathHelper::make_absolute( $uri, AS_SPEAKING_URL );

		return $uri;
	}

	/**
	 * Get the enqueue closure to use.
	 *
	 * @since 0.1.0
	 *
	 * @return Closure
	 */
	abstract protected function get_register_closure();

	/**
	 * Get the enqueue closure to use.
	 *
	 * @since 0.1.0
	 *
	 * @return Closure
	 */
	abstract protected function get_enqueue_closure();
}
