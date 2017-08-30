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
 * Class StyleAsset.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking\Assets
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
class StyleAsset extends BaseAsset {

	const MEDIA_ALL    = 'all';
	const MEDIA_PRINT  = 'print';
	const MEDIA_SCREEN = 'screen';

	const DEFAULT_EXTENSION = 'css';

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
	 * Media for which the asset is defined.
	 *
	 * @since 0.1.0
	 *
	 * @var string
	 */
	protected $media;

	/**
	 * Instantiate a StyleAsset object.
	 *
	 * @since 0.1.0
	 *
	 * @param string           $handle       Handle of the asset.
	 * @param string           $source       Source location of the asset.
	 * @param array            $dependencies Optional. Dependencies of the
	 *                                       asset.
	 * @param string|bool|null $version      Optional. Version of the asset.
	 * @param string           $media        Media for which the asset is
	 *                                       defined.
	 */
	public function __construct(
		$handle,
		$source,
		$dependencies = [],
		$version = false,
		$media = self::MEDIA_ALL
	) {
		$this->handle       = $handle;
		$this->source       = $this->normalize_source(
			$source,
			static::DEFAULT_EXTENSION
		);
		$this->dependencies = (array) $dependencies;
		$this->version      = $version;
		$this->media        = $media;
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
			if ( wp_script_is( $this->handle, 'registered' ) ) {
				return;
			}

			wp_register_style(
				$this->handle,
				$this->source,
				$this->dependencies,
				$this->version,
				$this->media
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
			wp_enqueue_style( $this->handle );
		};
	}

	/**
	 * Get the dequeue closure to use.
	 *
	 * @since 0.2.7
	 *
	 * @return Closure
	 */
	protected function get_dequeue_closure() {
		return function () {
			wp_dequeue_style( $this->handle );
		};
	}
}
