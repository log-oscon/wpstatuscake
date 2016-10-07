<?php
/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       https://github.com/log-oscon/wpstatuscake/
 * @since      1.0.0
 *
 * @package    StatusCake
 * @subpackage StatusCake/lib
 */

namespace logoscon\StatusCake;

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @package    StatusCake
 * @subpackage StatusCake/lib
 * @author     log.OSCON, Lda. <engenharia@log.pt>
 */
class Admin {

	/**
	 * The plugin's instance.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    Plugin
	 */
	private $plugin;

	/**
	 * The unique identifier of this plugin settings group name.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $settings_name = 'statuscake_settings';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param Plugin $plugin This plugin's instance.
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * The settings group name.
	 *
	 * @since  1.0.0
	 * @return string The settings group name.
	 */
	public function get_settings_name() {
		return $this->settings_name;
	}

	/**
	 * Add sub menu page to the Settings menu.
	 *
	 * @since 1.0.0
	 */
	public function admin_settings_menu() {

		if ( ! \current_user_can( 'manage_options' ) ) {
			return;
		}

		\add_options_page(
			\__( 'StatusCake', 'wpstatuscake' ),
			\__( 'StatusCake', 'wpstatuscake' ),
			'manage_options',
			'statuscake',
			array( $this, 'display_options_page' )
		);

	}

	/**
	 * Output the content of the settings page.
	 *
	 * @since 1.0.0
	 */
	public function display_options_page() {
	?>
		<div class="wrap">
			<h1><?php \_e( 'StatusCake Settings', 'wpstatuscake' ); ?></h1>
			<form action='options.php' method='post'>
			<?php
				\settings_fields( $this->get_settings_name() );
				\do_settings_sections( $this->get_settings_name() );
				\submit_button();
			?>
			</form>
		</div>
	<?php
	}

	/**
	 * Register groups of settings and their fields.
	 *
	 * @since 1.0.0
	 */
	public function admin_settings_init() {
		$this->register_settings_sections();
		$this->register_settings_fields();
	}

	/**
	 * Register groups of settings.
	 *
	 * @since 1.0.0
	 */
	public function register_settings_sections() {

		\add_settings_section(
			'statuscake_settings_section',
			'',
			null,
			$this->get_settings_name()
		);

	}

	/**
	 * Register settings fields..
	 *
	 * @since 1.0.0
	 */
	public function register_settings_fields() {
		$this->register_rum_id();
	}

	/**
	 * Register `Real User Monitoring ID` setting.
	 *
	 * @since 1.0.0
	 */
	public function register_rum_id() {

		\register_setting(
			$this->get_settings_name(),
			'statuscake_rum_id',
			'sanitize_text_field'
		);

		\add_settings_field(
			'statuscake_rum_id',
			\__( 'Real User Monitoring ID', 'wpstatuscake' ),
			array( $this, 'display_rum_id' ),
			$this->get_settings_name(),
			'statuscake_settings_section',
			array(
				'label_for' => 'statuscake_rum_id'
			)
		);

	}

	/**
	 * Output the RUM ID field.
	 *
	 * @since 1.0.0
	 */
	public function display_rum_id() {

		printf(
			'<input type="text" id="%1$s" name="%1$s" value="%2$s">',
			'statuscake_rum_id',
			\get_option( 'statuscake_rum_id' )
		);

	}
}
