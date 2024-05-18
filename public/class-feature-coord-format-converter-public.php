<?php

class Feature_Coord_Format_Converter_Public {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/feature-coord-format-converter-public.css', array(), $this->version, 'all' );

        $script_path = plugin_dir_path( dirname( __FILE__ ) ).'vue/dist/assets/index.css';
        $script_url =  plugin_dir_url( dirname( __FILE__ )).'vue/dist/assets/index.css';

        $version = filemtime($script_path); // Get the file modification time

        wp_enqueue_style( 'fcfc-vue-css',   $script_url, array(),  $version );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/feature-coord-format-converter-public.js', array( 'jquery' ), $this->version, false );

        $script_path = plugin_dir_path( dirname( __FILE__ ) ).'vue/dist/assets/bundle.js';
        $script_url =  plugin_dir_url( dirname( __FILE__ )).'vue/dist/assets/bundle.js';

        $version = filemtime($script_path); // Get the file modification time

        wp_enqueue_script( 'fcfc-vue-js',  $script_url, array('jquery'),   $version , true);

	}

    public function display_form_fcfc_func() {

        return '<div id="app-fcfc"></div>';

    }

}
