<?php

class Feature_Coord_Format_Converter_Activator {
	public static function activate() {

        global $wpdb;
        $coords = $wpdb->prefix.'coords';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE " . $coords . "(
         ID         int         NOT NULL,   
         notes      text,  
         lat        text,
         lng        text,
         format_type    text,   
         PRIMARY KEY (ID)
        ) $charset_collate; ";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        ob_start();

        dbDelta($sql);

        ob_end_clean();

	}
}