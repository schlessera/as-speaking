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

$upcoming_header = false;
$past_header     = false;
$timestamp       = time();

?><div class="speaking-page-talks">
	<?php foreach ( $this->talks as $talk ) :  /** @var Talk $talk */ ?>
		<?php if ( ! $upcoming_header && $talk->get_session_date() >= $timestamp ) { ?>
			<h3><?= __( 'Upcoming Talks', 'as-speaking' ) ?></h3>
			<?php $upcoming_header = true; ?>
		<?php } else if ( ! $past_header && $talk->get_session_date() < $timestamp ) { ?>
			<h3><?= __( 'Past Talks', 'as-speaking' ) ?></h3>
			<?php $past_header = true; ?>
		<?php } ?>
		<?= $this->render_partial( 'views/speaking-page-talk',
			[ 'talk' => $talk ] ) ?>
	<?php endforeach; ?>
</div>
