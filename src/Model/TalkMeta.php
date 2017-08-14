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

namespace AlainSchlesser\Speaking\Model;

/**
 * Class TalkMeta.
 *
 * @since   0.2.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
interface TalkMeta {

	const EVENT_NAME   = 'event_name';
	const EVENT_LINK   = 'event_link';
	const SESSION_DATE = 'session_date';
	const SESSION_LINK = 'session_link';
	const VIDEO        = 'video';
	const SLIDES       = 'slides';
	const IMAGE_LINK   = 'image_link';

	const PROPERTIES = [
		self::EVENT_NAME,
		self::EVENT_LINK,
		self::SESSION_DATE,
		self::SESSION_LINK,
		self::VIDEO,
		self::SLIDES,
		self::IMAGE_LINK,
	];

	const IMAGE_LINK_NOTHING = 'nothing';
	const IMAGE_LINK_EVENT   = 'event';
	const IMAGE_LINK_SESSION = 'session';
	const IMAGE_LINK_VIDEO   = 'video';
	const IMAGE_LINK_SLIDES  = 'slides';

	const FORM_FIELD_PREFIX = 'talk_cpt_';
	const FORM_FIELD_SESSION_AA = self::FORM_FIELD_PREFIX . 'session_aa';
	const FORM_FIELD_SESSION_MM = self::FORM_FIELD_PREFIX . 'session_mm';
	const FORM_FIELD_SESSION_JJ = self::FORM_FIELD_PREFIX . 'session_jj';
	const META_PREFIX       = 'talk_cpt_meta_';
}
