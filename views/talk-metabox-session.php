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

use DateTime;

global $wp_locale;

$session_date = $this->talk->get_session_date();
$session_date_time = new DateTime();
$session_date_time->setTimestamp( $session_date );
$session_date_string = date_i18n( get_option( 'date_format' ), $session_date );

$session_display = empty( $this->talk->get_session_link() )
	? $session_date_string
	: "<a href=\"{$this->talk->get_session_link()}\">{$session_date_string}</a>";

$jj = $session_date_time->format( 'd' );
$mm = $session_date_time->format( 'm' );
$aa = $session_date_time->format( 'Y' );

$month = '<label><span class="screen-reader-text">' . __( 'Month' ) . '</span><select id="talk_cpt_session_mm" name="talk_cpt_session_mm">';
for ( $i = 1; $i < 13; $i++ ) {
	$monthnum = zeroise($i, 2);
	$monthtext = $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
	$month .= "\t\t\t" . '<option value="' . $monthnum . '" data-text="' . $monthtext . '" ' . selected( $monthnum, $mm, false ) . '>';
	/* translators: 1: month number (01, 02, etc.), 2: month abbreviation */
	$month .= sprintf( __( '%1$s-%2$s' ), $monthnum, $monthtext ) . '</option>';
}
$month .= '</select></label>';

$day = '<label><span class="screen-reader-text">' . __( 'Day' ) . '</span><input type="text" id="talk_cpt_session_jj" name="talk_cpt_session_jj" value="' . $jj . '" size="2" maxlength="2" autocomplete="off" /></label>';

$year = '<label><span class="screen-reader-text">' . __( 'Year' ) . '</span><input type="text" id="talk_cpt_session_aa" name="talk_cpt_session_aa" value="' . $aa . '" size="4" maxlength="4" autocomplete="off" /></label>';

$sessions_date_fields = '<div id="talk_cpt_session_timestamp" class="talk_cpt_session_timestamp-wrap">';
$sessions_date_fields .= sprintf(
	/* translators: 1: month, 2: day, 3: year */
	__( '%1$s %2$s, %3$s' ),
	$month,
	$day,
	$year
);

$map = array(
	'talk_cpt_session_mm' => $mm,
	'talk_cpt_session_jj' => $jj,
	'talk_cpt_session_aa' => $aa,
);

foreach ( $map as $timeunit => $value ) {
	$sessions_date_fields .= '<input type="hidden" id="hidden_' . $timeunit . '" name="hidden_' . $timeunit . '" value="' . $value . '" />';
}
$sessions_date_fields .= '</div>';

?><div class="talk-cpt-metabox-section talk-cpt-metabox-section-session"><?= __('Session:', 'as-speaking' ) ?> <span id="talk-cpt-session-display"><?= $session_display ?></span>
	<a href="#talk_cpt_session_timestamp" class="edit-talk-cpt-session hide-if-no-js"><span class="button-edit"><?= __('Edit', 'as-speaking' ) ?></span> <span class="screen-reader-text">Edit session date and link</span></a>
	<fieldset id="talk-cpt-session-fields" class="hide-if-js" style="display: none;">
		<input type="hidden" name="hidden_talk_cpt_session_date" id="hidden_talk_cpt_session_date" value="<?= $this->talk->get_session_date() ?>">
		<input type="hidden" name="hidden_talk_cpt_session_link" id="hidden_talk_cpt_session_link" value="<?= $this->talk->get_session_link() ?>">
		<legend><?= __( 'Date of the session:', 'as-speaking' ) ?></legend>
		<?= $sessions_date_fields ?>
		<label for="talk_cpt_session_link"><?= __('URL the session should link to:', 'as-speaking' ) ?></label>
		<input type="text" id="talk_cpt_session_link" name="talk_cpt_session_link" value="<?= $this->talk->get_session_link() ?>">
		<a href="#talk_cpt_session_timestamp" class="save-talk-cpt-session hide-if-no-js button">OK</a>
		<a href="#talk_cpt_session_timestamp" class="cancel-talk-cpt-session hide-if-no-js button-cancel">Cancel</a>
	</fieldset>
</div>
