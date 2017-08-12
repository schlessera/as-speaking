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

use AlainSchlesser\Speaking\Exception\InvalidAssetHandle;

/**
 * Trait AssetsAwareTrait
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
trait AssetsAwareTrait {

	/**
	 * Assets handler instance to use.
	 *
	 * @since 0.1.0
	 *
	 * @var AssetsHandler
	 */
	protected $assets_handler;

	/**
	 * Get the array of known assets.
	 *
	 * @since 0.1.0
	 *
	 * @return array<Asset>
	 */
	protected function get_assets() {
		return [];
	}

	/**
	 * Register the known assets.
	 *
	 * @since 0.1.0
	 */
	protected function register_assets() {
		foreach ( $this->get_assets() as $asset ) {
			$this->assets_handler->add( $asset );
		}
	}

	/**
	 * Enqueue the known assets.
	 *
	 * @since 0.1.0
	 *
	 * @throws InvalidAssetHandle If the passed-in asset handle is not valid.
	 */
	protected function enqueue_assets() {
		foreach ( $this->get_assets() as $asset ) {
			$this->assets_handler->enqueue( $asset );
		}
	}

	/**
	 * Enqueue a single asset.
	 *
	 * @since 0.1.0
	 *
	 * @param string $handle Handle of the asset to enqueue.
	 *
	 * @throws InvalidAssetHandle If the passed-in asset handle is not valid.
	 */
	protected function enqueue_asset( $handle ) {
		$this->assets_handler->enqueue_handle( $handle );
	}

	/**
	 * Set the assets handler to use within this object.
	 *
	 * @since 0.1.0
	 *
	 * @param AssetsHandler $assets Assets handler to use.
	 */
	public function with_assets_handler( AssetsHandler $assets ) {
		$this->assets_handler = $assets;
	}
}
