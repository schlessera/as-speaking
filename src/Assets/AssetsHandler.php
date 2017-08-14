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
use AlainSchlesser\Speaking\Registerable;

/**
 * Class AssetsHandler.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class AssetsHandler implements Registerable {

	/**
	 * Assets known to this asset handler.
	 *
	 * @since 0.1.0
	 *
	 * @var array<Asset>
	 */
	private $assets;

	/**
	 * Add a single asset to the asset handler.
	 *
	 * @since 0.1.0
	 *
	 * @param Asset $asset Asset to add.
	 */
	public function add( Asset $asset ) {
		$this->assets[ $asset->get_handle() ] = $asset;
	}

	/**
	 * Register the current Registerable.
	 *
	 * @since 0.1.0
	 *
	 * @return void
	 */
	public function register() {
		foreach ( $this->assets as $asset ) {
			$asset->register();
		}
	}

	/**
	 * Enqueue a single asset based on its handle.
	 *
	 * @since 0.1.0
	 *
	 * @param string $handle Handle of the asset to enqueue.
	 *
	 * @throws InvalidAssetHandle If the passed-in asset handle is not valid.
	 */
	public function enqueue_handle( $handle ) {
		if ( ! array_key_exists( $handle, $this->assets ) ) {
			throw InvalidAssetHandle::from_handle( $handle );
		}
		$this->assets[ $handle ]->enqueue();
	}

	/**
	 * Enqueue all assets known to this asset handler.
	 *
	 * @since 0.1.0
	 *
	 * @param Asset|null $asset Optional. Asset to enqueue. If omitted, all
	 *                          known assets are enqueued.
	 */
	public function enqueue( Asset $asset = null ) {
		$assets = $asset ? [ $asset ] : $this->assets;
		foreach ( $assets as $asset_object ) {
			$asset_object->enqueue();
		}
	}
}
