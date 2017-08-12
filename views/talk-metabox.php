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

?>
<form class="talk-cpt-metabox">
	<?= $this->nonce_field ?>
	<?= $this->render_partial( 'views/talk-metabox-event' ) ?>
	<?= $this->render_partial( 'views/talk-metabox-session' ) ?>
	<?= $this->render_partial( 'views/talk-metabox-video' ) ?>
	<?= $this->render_partial( 'views/talk-metabox-slides' ) ?>
	<?= $this->render_partial( 'views/talk-metabox-image-link' ) ?>
</form>
