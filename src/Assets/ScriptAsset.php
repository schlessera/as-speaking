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

use Closure;

/**
 * Class ScriptAsset.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Assets
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class ScriptAsset extends BaseAsset {

	const ENQUEUE_HEADER = false;
	const ENQUEUE_FOOTER = true;

	const DEFAULT_EXTENSION = 'js';

	/**
	 * Source location of the asset.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $source;

	/**
	 * Dependencies of the asset.
	 *
	 * @since 0.1.0
	 *
	 * @var array<string>
	 */
	protected $dependencies;

	/**
	 * Version of the asset.
	 *
	 * @since 0.1.0
	 *
	 * @var string|bool|null
	 */
	protected $version;

	/**
	 * Whether to enqueue the script in the footer.
	 *
	 * @since 0.1.0
	 *
	 * @var bool
	 */
	protected $in_footer;

	/**
	 * Instantiate a ScriptAsset object.
	 *
	 * @since 0.1.0
	 *
	 * @param string           $handle       Handle of the asset.
	 * @param string           $source       Source location of the asset.
	 * @param array            $dependencies Optional. Dependencies of the
	 *                                       asset.
	 * @param string|bool|null $version      Optional. Version of the asset.
	 * @param bool             $in_footer    Whether to enqueue the asset in
	 *                                       the footer.
	 */
	public function __construct(
		$handle,
		$source,
		$dependencies = [],
		$version = false,
		$in_footer = self::ENQUEUE_HEADER
	) {
		$this->handle       = $handle;
		$this->source       = $this->normalize_source(
			$source,
			static::DEFAULT_EXTENSION
		);
		$this->dependencies = (array) $dependencies;
		$this->version      = $version;
		$this->in_footer    = $in_footer;
	}

	/**
	 * Get the enqueue closure to use.
	 *
	 * @since 0.1.0
	 *
	 * @return Closure
	 */
	protected function get_register_closure() {
		return function () {
			wp_register_script(
				$this->handle,
				$this->source,
				$this->dependencies,
				$this->version,
				$this->in_footer
			);
		};
	}

	/**
	 * Get the enqueue closure to use.
	 *
	 * @since 0.1.0
	 *
	 * @return Closure
	 */
	protected function get_enqueue_closure() {
		return function () {
			wp_enqueue_script( $this->handle );
		};
	}
}
