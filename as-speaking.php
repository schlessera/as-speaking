<?php
/**
 * AlainSchlesser.com Speaking Page Plugin.
 *
 * @package   AlainSchlesser\Speaking
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.alainschlesser.com/
 * @copyright 2017 Alain Schlesser
 *
 * @wordpress-plugin
 * Plugin Name: AlainSchlesser.com Speaking Page Plugin.
 * Plugin URI:  https://www.alainschlesser.com/
 * Description: Custom post type and presentation tools for a page to promote your speaking gigs.
 * Version:     0.2.3
 * Author:      Alain Schlesser <alain.schlesser@gmail.com>
 * Author URI:  https://www.alainschlesser.com/
 * Text Domain: as-speaking
 * Domain Path: /languages
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 */

namespace AlainSchlesser\Speaking;

use AlainSchlesser\Speaking\Plugin as SpeakingPlugin;

// Store plugin root folder.
if ( ! defined( 'AS_SPEAKING_DIR' ) ) {
	define( 'AS_SPEAKING_DIR', trailingslashit( __DIR__ ) );
}

// Store plugin root URL.
if ( ! defined( 'AS_SPEAKING_URL' ) ) {
	define( 'AS_SPEAKING_URL', plugin_dir_url( __FILE__ ) );
}

// Load Autoloader class and register plugin namespace.
require_once AS_SPEAKING_DIR . 'src/Autoloader.php';
( new Autoloader() )
	->add_namespace( 'AlainSchlesser\\Speaking', AS_SPEAKING_DIR . 'src' )
	->register();

// Hook plugin into WordPress request lifecycle.
( new SpeakingPlugin() )
	->register();
