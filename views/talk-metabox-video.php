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

$video_display = empty( $this->talk->get_video() )
	? ''
	: sprintf(
		'<a href="%s">%s</a>',
		$this->talk->get_video(),
		__( 'Link', 'as-speaking' )
	);

?><div class="talk-cpt-metabox-section talk-cpt-metabox-section-video"><?= __('Video:', 'as-speaking' ) ?> <span id="talk-cpt-video-display"><?= $video_display ?></span>
	<a href="#talk_cpt_video" class="edit-talk-cpt-video hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
		<span class="screen-reader-text"><?= __('Edit video', 'as-speaking' ) ?></span></a>
	<div id="talk-cpt-video-input" class="hide-if-js" style="display: none;">
		<input type="hidden" name="hidden_talk_cpt_video" id="hidden_talk_cpt_video" value="<?= $this->talk->get_video() ?>">
		<label for="talk_cpt_video"><?= __('Set the link to the video recording:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_video" name="talk_cpt_video" value="<?= $this->talk->get_video() ?>">
		<a href="#talk_cpt_video" class="save-talk-cpt-video hide-if-no-js button"><?= __( 'OK', 'as-speaking' ) ?></a>
		<a href="#talk_cpt_video" class="cancel-talk-cpt-video hide-if-no-js button-cancel"><?= __( 'Cancel', 'as-speaking' ) ?></a>
	</div>
</div>
