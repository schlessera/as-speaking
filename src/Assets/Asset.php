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

use AlainSchlesser\Speaking\Registerable;

/**
 * Interface Asset.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Assets
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface Asset extends Registerable {

	/**
	 * Enqueue the asset.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function enqueue();

	/**
	 * Get the handle of the asset.
	 *
	 * @since 0.1.0
	 *
	 * @return string
	 */
	public function get_handle();
}
