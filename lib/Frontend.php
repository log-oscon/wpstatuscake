<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/log-oscon/wpstatuscake/
 * @since      1.0.0
 *
 * @package    StatusCake
 * @subpackage StatusCake/lib
 */

namespace logoscon\StatusCake;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    StatusCake
 * @subpackage StatusCake/lib
 * @author     log.OSCON, Lda. <engenharia@log.pt>
 */
class Frontend {

	/**
	 * The plugin's instance.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       Plugin    $plugin    This plugin's instance.
	 */
	private $plugin;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    Plugin    $plugin    This plugin's instance.
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Register the scripts for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if ( \is_admin() ) {
			return;
		}

		if ( \is_feed() ) {
			return;
		}

		if ( \is_robots() ) {
			return;
		}

		if ( \is_trackback() ) {
			return;
		}

		$rum_id = \get_option( 'statuscake_rum_id' );

		if ( empty( $rum_id ) ) {
			return;
		}

		\wp_enqueue_script(
			$this->plugin->get_plugin_name(),
			'https://www.statuscake.com/App/RUM/embed.js',
			array(),
			false,
			true
		);

		\wp_localize_script(
			$this->plugin->get_plugin_name(),
			'SC_RumID',
			$rum_id
		);

	}

	/**
	 * Add async attribute to the HTML script tag of the enqueued script.
	 *
	 * @since     1.0.0
	 * @param     string    $tag       The script's tag for the enqueued script.
	 * @param     string    $handle    The script's registered handle.
	 * @return    string               Possibly modified script's tag.
	 */
	public function add_async_attribute( $tag, $handle ) {

		if ( $this->plugin->get_plugin_name() !== $handle ) {
			return $tag;
		}

		return str_replace( ' src', ' async src', $tag );
	}

}
