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

?><div class="speaking-widget-talk">
	<h6 class="speaking-widget-talk-title"><?= $this->talk->get_title() ?></h6>
	<p class="speaking-widget-talk-meta">
		<?php if ( ! empty( $this->talk->get_event_name() ) ) : ?>
			<div class="speaking-widget-talk-event"><a href="<?= $this->talk->get_event_link() ?>"><?= $this->talk->get_event_name() ?></a></div>
		<?php endif; ?>
		<?php if ( ! empty( $this->talk->get_session_date() ) ) : ?>
			<div class="speaking-widget-talk-session"><a href="<?= $this->talk->get_session_link() ?>"><?= empty( $this->talk->get_session_date() ) ? '' : date_i18n( get_option( 'date_format' ), $this->talk->get_session_date() ) ?></a></div>
		<?php endif; ?>
		<?php if ( ! empty( $this->talk->get_video() ) ) : ?>
			<div class="speaking-widget-talk-video"><a href="<?= $this->talk->get_video() ?>"><?= __( 'Video', 'as-speaking' ) ?></a></div>
		<?php endif; ?>
		<?php if ( ! empty( $this->talk->get_slides() ) ) : ?>
			<div class="speaking-widget-talk-slides"><a href="<?= $this->talk->get_slides() ?>"><?= __( 'Slides', 'as-speaking' ) ?></a></div>
		<?php endif; ?>
	</p>
</div>
