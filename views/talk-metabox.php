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

use AlainSchlesser\Speaking\Model\Talk;

$event_display = empty( $this->talk->get_event_link() )
	? $this->talk->get_event_name()
	: "<a href=\"{$this->talk->get_event_link()}\">{$this->talk->get_event_name()}</a>";

$session_display = empty( $this->talk->get_session_link() )
	? $this->talk->get_session_date()
	: "<a href=\"{$this->talk->get_session_link()}\">{$this->talk->get_session_date()}</a>";

$video_display = empty( $this->talk->get_video() )
	? ''
	: "<a href=\"{$this->talk->get_video()}\">Link</a>";

$slides_display = empty( $this->talk->get_slides() )
	? ''
	: "<a href=\"{$this->talk->get_slides()}\">Link</a>";

$image_link_captions = [
	Talk::IMAGE_LINK_NOTHING => __( 'Nothing', 'as-speaking' ),
	Talk::IMAGE_LINK_EVENT   => __( 'Event', 'as-speaking' ),
	Talk::IMAGE_LINK_SESSION => __( 'Session', 'as-speaking' ),
	Talk::IMAGE_LINK_VIDEO   => __( 'Video', 'as-speaking' ),
	Talk::IMAGE_LINK_SLIDES  => __( 'Slides', 'as-speaking' ),
];

?>
<form class="talk-cpt-metabox">
	<?= $this->nonce_field ?>

	<!-- Event section-->
	<div class="talk-cpt-metabox-section talk-cpt-metabox-section-event"><?= __('Event:', 'as-speaking' ) ?> <span id="talk-cpt-event-display"><?= $event_display ?></span>
		<a href="#talk_cpt_event_name" class="edit-talk-cpt-event hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
			<span class="screen-reader-text"><?= __('Edit event', 'as-speaking' ) ?></span></a>
		<div id="talk-cpt-event-fields" class="hide-if-js" style="display: none;">
			<input type="hidden" name="hidden_talk_cpt_event_name" id="hidden_talk_cpt_event_name" value="<?= $this->talk->get_event_name() ?>">
			<input type="hidden" name="hidden_talk_cpt_event_link" id="hidden_talk_cpt_event_link" value="<?= $this->talk->get_event_link() ?>">
			<label for="talk_cpt_event_name"><?= __('Set the name of the event:', 'as-speaking' ) ?></label>
			<input type="text" id="talk_cpt_event_name" name="talk_cpt_event_name" value="<?= $this->talk->get_event_name() ?>">
			<label for="talk_cpt_event_link"><?= __('Set the link the event should point to:', 'as-speaking' ) ?></label>
			<input type="text" id="talk_cpt_event_link" name="talk_cpt_event_link" value="<?= $this->talk->get_event_link() ?>">
			<a href="#talk_cpt_event_name" class="save-talk-cpt-event hide-if-no-js button">OK</a>
			<a href="#talk_cpt_event_name" class="cancel-talk-cpt-event hide-if-no-js button-cancel">Cancel</a>
		</div>
	</div>

	<!-- Session section-->
	<div class="talk-cpt-metabox-section talk-cpt-metabox-section-session"><?= __('Session:', 'as-speaking' ) ?> <span id="talk-cpt-session-display"><?= $session_display ?></span>
		<a href="#talk_cpt_session_date" class="edit-talk-cpt-session hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
			<span class="screen-reader-text"><?= __('Edit session', 'as-speaking' ) ?></span></a>
		<div id="talk-cpt-session-fields" class="hide-if-js" style="display: none;">
			<input type="hidden" name="hidden_talk_cpt_session_date" id="hidden_talk_cpt_session_date" value="<?= $this->talk->get_session_date() ?>">
			<input type="hidden" name="hidden_talk_cpt_session_link" id="hidden_talk_cpt_session_link" value="<?= $this->talk->get_session_link() ?>">
			<label for="talk_cpt_session_date"><?= __('Set the date of the session:', 'as-speaking' ) ?></label>
			<input type="text" id="talk_cpt_session_date" name="talk_cpt_session_date" value="<?= $this->talk->get_session_date() ?>">
			<label for="talk_cpt_session_link"><?= __('Set the link the session should point to:', 'as-speaking' ) ?></label>
			<input type="text" id="talk_cpt_session_link" name="talk_cpt_session_link" value="<?= $this->talk->get_session_link() ?>">
			<a href="#talk_cpt_session_date" class="save-talk-cpt-session hide-if-no-js button">OK</a>
			<a href="#talk_cpt_session_date" class="cancel-talk-cpt-session hide-if-no-js button-cancel">Cancel</a>
		</div>
	</div>

	<!-- Video section-->
	<div class="talk-cpt-metabox-section talk-cpt-metabox-section-video"><?= __('Video:', 'as-speaking' ) ?> <span id="talk-cpt-video-display"><?= $video_display ?></span>
		<a href="#talk_cpt_video" class="edit-talk-cpt-video hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
			<span class="screen-reader-text"><?= __('Edit video', 'as-speaking' ) ?></span></a>
		<div id="talk-cpt-video-input" class="hide-if-js" style="display: none;">
			<input type="hidden" name="hidden_talk_cpt_video" id="hidden_talk_cpt_video" value="<?= $this->talk->get_video() ?>">
			<label for="talk_cpt_video"><?= __('Set the link to the video recording:', 'as-speaking' ) ?></label>
			<input type="text" id="talk_cpt_video" name="talk_cpt_video" value="<?= $this->talk->get_video() ?>">
			<a href="#talk_cpt_video" class="save-talk-cpt-video hide-if-no-js button">OK</a>
			<a href="#talk_cpt_video" class="cancel-talk-cpt-video hide-if-no-js button-cancel">Cancel</a>
		</div>
	</div>

	<!-- Slides section-->
	<div class="talk-cpt-metabox-section talk-cpt-metabox-section-slides"><?= __('Slides:', 'as-speaking' ) ?> <span id="talk-cpt-slides-display"><?= $slides_display ?></span>
		<a href="#talk_cpt_slides" class="edit-talk-cpt-slides hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
			<span class="screen-reader-text"><?= __('Edit slides', 'as-speaking' ) ?></span></a>
		<div id="talk-cpt-slides-input" class="hide-if-js" style="display: none;">
			<input type="hidden" name="hidden_talk_cpt_slides" id="hidden_talk_cpt_slides" value="<?= $this->talk->get_slides() ?>">
			<label for="talk_cpt_slides"><?= __('Set the link to the slides:', 'as-speaking' ) ?></label>
			<input type="text" id="talk_cpt_slides" name="talk_cpt_slides" value="<?= $this->talk->get_slides() ?>">
			<a href="#talk_cpt_slides" class="save-talk-cpt-slides hide-if-no-js button">OK</a>
			<a href="#talk_cpt_slides" class="cancel-talk-cpt-slides hide-if-no-js button-cancel">Cancel</a>
		</div>
	</div>

	<!-- Featured Image Link section-->
	<div class="talk-cpt-metabox-section talk-cpt-metabox-section-featured-image"><?= __('Image links to:', 'as-speaking' ) ?> <span id="talk-cpt-image-link-display"><?= $image_link_captions[ $this->talk->get_image_link() ] ?></span>
		<a href="#talk_cpt_image_link" class="edit-talk-cpt-image-link hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
			<span class="screen-reader-text"><?= __('Edit featured image link', 'as-speaking' ) ?></span></a>
		<div id="talk-cpt-image-link-select" class="hide-if-js" style="display: none;">
			<input type="hidden" name="hidden_talk_cpt_image_link" id="hidden_talk_cpt_image_link" value="<?= $this->talk->get_image_link() ?>">
			<label for="talk_cpt_image_link" class="screen-reader-text"><?= __('Set element the featured image will link to', 'as-speaking' ) ?></label>
			<select name="talk_cpt_image_link" id="talk_cpt_image_link">
				<?php foreach( $image_link_captions as $value => $caption ) : ?>
					<option <?php selected( $this->talk->get_image_link(), $value ); ?> value="<?= $value ?>"><?= $caption ?></option>
				<?php endforeach; ?>
			</select>
			<a href="#talk_cpt_image_link" class="save-talk-cpt-image-link hide-if-no-js button">OK</a>
			<a href="#talk_cpt_image_link" class="cancel-talk-cpt-image-link hide-if-no-js button-cancel">Cancel</a>
		</div>
	</div>
</form>
