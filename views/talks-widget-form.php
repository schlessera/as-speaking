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

?><p>
	<label for="<?php echo esc_attr( $this->title_id ); ?>"><?php esc_attr_e( 'Title:', 'as-speaking' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $this->title_id ); ?>" name="<?php echo esc_attr( $this->title_name ); ?>" type="text" value="<?php echo esc_attr( $this->title ); ?>">
</p>
