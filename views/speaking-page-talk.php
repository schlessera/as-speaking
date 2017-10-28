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

?><div class="talks__container">
	<div class="talk__featured-image"><?= $this->talk->get_featured_image() ?></div>
	<h4 class="talk__title"><?= $this->talk->get_title() ?></h4>
	<ul class="talk__meta-container">
		<?php if ( ! empty( $this->talk->get_event_name() ) ) : ?>
			<li class="talk__meta talk__meta--event"><a href="<?= $this->talk->get_event_link() ?>"><?= $this->talk->get_event_name() ?></a></li>
		<?php endif; ?>
		<?php if ( ! empty( $this->talk->get_session_date() ) ) : ?>
			<li class="talk__meta talk__meta--session"><a href="<?= $this->talk->get_session_link() ?>"><?= empty( $this->talk->get_session_date() ) ? '' : date_i18n( get_option( 'date_format' ), $this->talk->get_session_date() ) ?></a></li>
		<?php endif; ?>
		<?php if ( ! empty( $this->talk->get_video() ) ) : ?>
			<li class="talk__meta talk__meta--video"><a href="<?= $this->talk->get_video() ?>"><?= __( 'Video', 'as-speaking' ) ?></a></li>
		<?php endif; ?>
		<?php if ( ! empty( $this->talk->get_slides() ) ) : ?>
			<li class="talk__meta talk__meta--slides"><a href="<?= $this->talk->get_slides() ?>"><?= __( 'Slides', 'as-speaking' ) ?></a></li>
		<?php endif; ?>
	</ul>
	<div class="talk__content"><?= wpautop( $this->talk->get_content() ) ?></div>
</div>
