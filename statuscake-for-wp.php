<?php

/**
 * StatusCake for WordPress
 *
 * This plugin allows you to easily integrate StatusCake into your WordPress website.
 *
 * @link              http://log.pt/
 * @since             1.0.0
 * @package           StatusCake
 *
 * @wordpress-plugin
 * Plugin Name:       StatusCake for WordPress
 * Plugin URI:        https://github.com/log-oscon/statuscake-for-wp/
 * Description:       Easy integration of StatusCake into your WordPress website.
 * Version:           1.0.0
 * Author:            log.OSCON, Lda.
 * Author URI:        http://log.pt/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       statuscake-for-wp
 * Domain Path:       /languages
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
 * @since    1.0.0
 */
\add_action( 'plugins_loaded', function () {
    $plugin = new StatusCake\Plugin();
    $plugin->run();
} );
