<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/davesuy
 * @since             1.0.0
 * @package           Feature_Coord_Format_Converter
 *
 * @wordpress-plugin
 * Plugin Name:       Feature Coord Format Converter
 * Plugin URI:        https://https://github.com/davesuy/feature-coord-format-converter
 * Description:       This plugin converts coordinates to DMS format or DD format depending on the selection.
 * Version:           1.0.0
 * Author:            Dave Ramirez
 * Author URI:        https://https://github.com/davesuy/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       feature-coord-format-converter
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'FEATURE_COORD_FORMAT_CONVERTER_VERSION', '1.0.0' );

function activate_feature_coord_format_converter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-feature-coord-format-converter-activator.php';
	Feature_Coord_Format_Converter_Activator::activate();
}

function deactivate_feature_coord_format_converter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-feature-coord-format-converter-deactivator.php';
	Feature_Coord_Format_Converter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_feature_coord_format_converter' );
register_deactivation_hook( __FILE__, 'deactivate_feature_coord_format_converter' );

require plugin_dir_path( __FILE__ ) . 'includes/class-feature-coord-format-converter.php';

function run_feature_coord_format_converter() {

	$plugin = new Feature_Coord_Format_Converter();
	$plugin->run();

}
run_feature_coord_format_converter();