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
 * Plugin Name:  AlainSchlesser.com Speaking Page Plugin.
 * Plugin URI:   https://www.alainschlesser.com/
 * Description:  Custom post type and presentation tools for a page to promote your speaking gigs.
 * Version:      0.2.9
 * Requires PHP: 5.6
 * Author: Alain Schlesser <alain.schlesser@gmail.com>
 * Author URI:   https://www.alainschlesser.com/
 * Text Domain:  as-speaking
 * Domain Path:  /languages
 * License:      MIT
 * License URI:  https://opensource.org/licenses/MIT
 */

namespace AlainSchlesser\Speaking;

// Make sure this file is only run from within WordPress.
defined( 'ABSPATH' ) or die();

// Load Autoloader class and register plugin namespace.
require_once __DIR__ . '/src/Autoloader.php';
( new Autoloader() )
	->add_namespace( __NAMESPACE__, __DIR__ . '/src' )
	->register();

// Hook plugin into WordPress request lifecycle.
PluginFactory::create()
             ->register();
