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
 * Interface Entity.
 *
 * @since   0.2.1
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface Entity {

	/**
	 * Return the entity ID.
	 *
	 * @since 0.2.1
	 *
	 * @return int Entity ID.
	 */
	public function get_ID();
}
