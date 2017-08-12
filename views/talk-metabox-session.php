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

$session_display = empty( $this->talk->get_session_link() )
	? $this->talk->get_session_date()
	: "<a href=\"{$this->talk->get_session_link()}\">{$this->talk->get_session_date()}</a>";

?><div class="talk-cpt-metabox-section talk-cpt-metabox-section-session"><?= __('Session:', 'as-speaking' ) ?> <span id="talk-cpt-session-display"><?= $session_display ?></span>
	<a href="#talk_cpt_session_date" class="edit-talk-cpt-session hide-if-no-js" style="display: inline;"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span>
		<span class="screen-reader-text"><?= __('Edit session', 'as-speaking' ) ?></span></a>
	<div id="talk-cpt-session-fields" class="hide-if-js" style="display: none;">
		<input type="hidden" name="hidden_talk_cpt_session_date" id="hidden_talk_cpt_session_date" value="<?= $this->talk->get_session_date() ?>">
		<input type="hidden" name="hidden_talk_cpt_session_link" id="hidden_talk_cpt_session_link" value="<?= $this->talk->get_session_link() ?>">
		<label for="talk_cpt_session_date"><?= __('Set the date of the session:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_session_date" name="talk_cpt_session_date" value="<?= $this->talk->get_session_date() ?>">
		<label for="talk_cpt_session_link"><?= __('Set the link the session should point to:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_session_link" name="talk_cpt_session_link" value="<?= $this->talk->get_session_link() ?>">
		<a href="#talk_cpt_session_date" class="save-talk-cpt-session hide-if-no-js button"><?= __( 'OK', 'as-speaking' ) ?></a>
		<a href="#talk_cpt_session_date" class="cancel-talk-cpt-session hide-if-no-js button-cancel"><?= __( 'Cancel', 'as-speaking' ) ?></a>
	</div>
</div>
