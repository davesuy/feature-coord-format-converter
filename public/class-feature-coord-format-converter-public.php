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

        wp_localize_script( 'fcfc-vue-js', 'frontend_ajax_object',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'home_domain' => get_bloginfo('url'),

            )
        );

	}

    public function display_form_fcfc_func() {

        return '<div id="app-fcfc"></div>';

    }

    public function register_routes() {

        register_rest_route(
            'fcfc/v1',
            '/add',
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [ $this, 'add_data' ],
                'permission_callback' => '__return_true',
            ]
        );



    }

    public function add_data(WP_REST_Request $request) {
        $body = $request->get_body();
        $body_decode = json_decode($body);

        global $wpdb;
        $table_name = $wpdb->prefix . 'coords';

        // Prepare sanitized data
        $data = array(
            'lat' => $body_decode->latitude,
            'lng' => $body_decode->longitude,
            'format_type' => $body_decode->coordinate,
        );


        $result = $wpdb->insert($table_name, $data);

        if ($result === false) {
            // Handle error if insertion fails
            echo "Error inserting data: " . $wpdb->last_error;
        } else {
            // Data inserted successfully
            echo "Data inserted successfully!";
        }

    }

}
