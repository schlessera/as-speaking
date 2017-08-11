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

?>
<form class="talk-cpt-metabox">
	<table>
		<tbody>
		<tr>
			<td>
				<h4 class="dashicons-before dashicons-admin-site"><?= __( 'Event', 'as-speaking' ) ?></h4>
				<label for="event-name"><?= __( 'Name:', 'as-speaking' ) ?></label>
				<input id="event-name" name="event-name">
			</td>
		</tr>
		<tr>
			<td>
				<label for="event-link"><?= __( 'Link:', 'as-speaking' ) ?></label>
				<input id="event-link" name="event-link">
			</td>
		</tr>
		<tr>
			<td>
				<h4 class="dashicons-before dashicons-calendar"><?= __( 'Session', 'as-speaking' ) ?></h4>
				<label for="session-date"><?= __( 'Date:', 'as-speaking' ) ?></label>
				<input id="session-date" name="session-date">
			</td>
		</tr>
		<tr>
			<td>
				<label for="session-link"><?= __( 'Link:', 'as-speaking' ) ?></label>
				<input id="session-link" name="session-link">
			</td>
		</tr>
		<tr>
			<td>
				<h4 class="dashicons-before dashicons-media-video"><?= __( 'Video', 'as-speaking' ) ?></h4>
				<label for="video-link"><?= __( 'Link:', 'as-speaking' ) ?></label>
				<input id="video-link" name="video-link">
			</td>
		</tr>
		<tr>
			<td>
				<h4 class="dashicons-before dashicons-media-interactive"> <?= __( 'Slides', 'as-speaking' ) ?></h4>
				<label for="slides-link"><?= __( 'Link:', 'as-speaking' ) ?></label>
				<input id="slides-link" name="slides-link">
			</td>
		</tr>
		<tr>
			<td>
				<h4 class="dashicons-before dashicons-format-image"><?= __( 'Featured Image', 'as-speaking' ) ?></h4>
				<label for="featured-link"><?= __( 'Featured Image links to:', 'as-speaking' ) ?></label>
				<div class="col-md-4">
					<select id="featured-link" name="featured-link"
					        class="form-control">
						<option value="nothing"><?= __( 'Nothing', 'as-speaking' ) ?></option>
						<option value="event"><?= __( 'Event Link', 'as-speaking' ) ?></option>
						<option value="session"><?= __( 'Session Link', 'as-speaking' ) ?></option>
						<option value="video"><?= __( 'Video Link', 'as-speaking' ) ?></option>
						<option value="slides"><?= __( 'Slides Link', 'as-speaking' ) ?></option>
					</select>
				</div>

			</td>
		</tr>
		</tbody>
	</table>
</form>
