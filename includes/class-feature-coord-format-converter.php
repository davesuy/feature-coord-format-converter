<?php

class Feature_Coord_Format_Converter {

	protected $loader;

	protected $plugin_name;

	protected $version;

	public function __construct() {
		if ( defined( 'FEATURE_COORD_FORMAT_CONVERTER_VERSION' ) ) {
			$this->version = FEATURE_COORD_FORMAT_CONVERTER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'feature-coord-format-converter';

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-feature-coord-format-converter-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-feature-coord-format-converter-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-feature-coord-format-converter-public.php';

		$this->loader = new Feature_Coord_Format_Converter_Loader();

	}

	private function define_admin_hooks() {

		$plugin_admin = new Feature_Coord_Format_Converter_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	private function define_public_hooks() {

		$plugin_public = new Feature_Coord_Format_Converter_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        /**
         * Shortcode
         */

        $this->loader->add_shortcode( 'display_form_fcfc', $plugin_public, 'display_form_fcfc_func' );

        /**
         * WP Rest API Integration
         */
        $this->loader->add_action( 'rest_api_init',  $plugin_public, 'register_routes' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
