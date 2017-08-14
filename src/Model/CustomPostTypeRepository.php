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

/**
 * Abstract class CustomPostTypeRepository.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
abstract class CustomPostTypeRepository {

	/**
	 * Persist a modified Talk to the storage.
	 *
	 * @since 0.1.0
	 *
	 * @param CustomPostTypeEntity $entity
	 */
	public function persist( CustomPostTypeEntity $entity ) {
		wp_insert_post( (array) $entity->get_post_object() );
		$entity->persist_properties();
	}
}
