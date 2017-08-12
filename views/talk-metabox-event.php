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

$event_display = empty( $this->talk->get_event_link() )
	? $this->talk->get_event_name()
	: "<a href=\"{$this->talk->get_event_link()}\">{$this->talk->get_event_name()}</a>";

?><div class="talk-cpt-metabox-section talk-cpt-metabox-section-event"><?= __('Event:', 'as-speaking' ) ?> <span id="talk-cpt-event-display"><?= $event_display ?></span>
	<a href="#talk_cpt_event_name" class="edit-talk-cpt-event hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
		<span class="screen-reader-text"><?= __('Edit event', 'as-speaking' ) ?></span></a>
	<div id="talk-cpt-event-fields" class="hide-if-js" style="display: none;">
		<input type="hidden" name="hidden_talk_cpt_event_name" id="hidden_talk_cpt_event_name" value="<?= $this->talk->get_event_name() ?>">
		<input type="hidden" name="hidden_talk_cpt_event_link" id="hidden_talk_cpt_event_link" value="<?= $this->talk->get_event_link() ?>">
		<label for="talk_cpt_event_name"><?= __('Set the name of the event:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_event_name" name="talk_cpt_event_name" value="<?= $this->talk->get_event_name() ?>">
		<label for="talk_cpt_event_link"><?= __('Set the link the event should point to:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_event_link" name="talk_cpt_event_link" value="<?= $this->talk->get_event_link() ?>">
		<a href="#talk_cpt_event_name" class="save-talk-cpt-event hide-if-no-js button"><?= __( 'OK', 'as-speaking' ) ?></a>
		<a href="#talk_cpt_event_name" class="cancel-talk-cpt-event hide-if-no-js button-cancel"><?= __( 'Cancel', 'as-speaking' ) ?></a>
	</div>
</div>
