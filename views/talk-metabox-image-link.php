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

$image_link_captions = [
	Talk::IMAGE_LINK_NOTHING => __( 'Nothing', 'as-speaking' ),
	Talk::IMAGE_LINK_EVENT   => __( 'Event', 'as-speaking' ),
	Talk::IMAGE_LINK_SESSION => __( 'Session', 'as-speaking' ),
	Talk::IMAGE_LINK_VIDEO   => __( 'Video', 'as-speaking' ),
	Talk::IMAGE_LINK_SLIDES  => __( 'Slides', 'as-speaking' ),
];

?><div class="talk-cpt-metabox-section talk-cpt-metabox-section-featured-image"><?= __('Image links to:', 'as-speaking' ) ?> <span id="talk-cpt-image-link-display"><?= $image_link_captions[ $this->talk->get_image_link() ] ?></span>
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
		<a href="#talk_cpt_image_link" class="save-talk-cpt-image-link hide-if-no-js button"><?= __( 'OK', 'as-speaking' ) ?></a>
		<a href="#talk_cpt_image_link" class="cancel-talk-cpt-image-link hide-if-no-js button-cancel"><?= __( 'Cancel', 'as-speaking' ) ?></a>
	</div>
</div>

