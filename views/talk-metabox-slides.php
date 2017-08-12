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

$slides_display = empty( $this->talk->get_slides() )
	? ''
	: sprintf(
		'<a href="%s">%s</a>',
		$this->talk->get_slides(),
		__( 'Link', 'as-speaking' )
	);

?><div class="talk-cpt-metabox-section talk-cpt-metabox-section-slides"><?= __('Slides:', 'as-speaking' ) ?> <span id="talk-cpt-slides-display"><?= $slides_display ?></span>
	<a href="#talk_cpt_slides" class="edit-talk-cpt-slides hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
		<span class="screen-reader-text"><?= __('Edit slides', 'as-speaking' ) ?></span></a>
	<div id="talk-cpt-slides-input" class="hide-if-js" style="display: none;">
		<input type="hidden" name="hidden_talk_cpt_slides" id="hidden_talk_cpt_slides" value="<?= $this->talk->get_slides() ?>">
		<label for="talk_cpt_slides"><?= __('Set the link to the slides:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_slides" name="talk_cpt_slides" value="<?= $this->talk->get_slides() ?>">
		<a href="#talk_cpt_slides" class="save-talk-cpt-slides hide-if-no-js button"><?= __( 'OK', 'as-speaking' ) ?></a>
		<a href="#talk_cpt_slides" class="cancel-talk-cpt-slides hide-if-no-js button-cancel"><?= __( 'Cancel', 'as-speaking' ) ?></a>
	</div>
</div>
