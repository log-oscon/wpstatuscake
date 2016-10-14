<?php
/**
 * StatusCake
 *
 * This plugin allows you to easily integrate StatusCake into your WordPress website.
 *
 * @link    http://log.pt/
 * @since   1.0.0
 *
 * @package StatusCake
 *
 * @wordpress-plugin
 * Plugin Name:       StatusCake
 * Plugin URI:        https://github.com/log-oscon/wpstatuscake/
 * Description:       Easy integration of StatusCake into your WordPress website.
 * Version:           1.0.11
 * Author:            log.OSCON, Lda.
 * Author URI:        http://log.pt/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpstatuscake
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/log-oscon/wpstatuscake
 * GitHub Branch:     master
 */

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

use logoscon\StatusCake;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
\add_action( 'plugins_loaded', function () {
	$plugin = new StatusCake\Plugin( 'wpstatuscake', '1.0.11' );
	$plugin->run();
} );
