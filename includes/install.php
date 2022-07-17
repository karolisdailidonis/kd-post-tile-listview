<?php

global $kd_tiles_portfolio__version;
$kd_tiles_portfolio__version = '0.1';

function kd_tiles_portfolio_activate() {
    global $wpdb, $kd_tiles_portfolio_version;

    add_option('visitcard_db_version', $kd_tiles_portfolio_version);
    update_option('visitcard_db_version', $kd_tiles_portfolio_version);

    // TABLE NAMES
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';
    $charset_collate    = $wpdb->get_charset_collate();

    // TABLE DATA
    $sql_tilelist_view = "CREATE TABLE $table_tilelist (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        template_id mediumint(9) DEFAULT 1,
        categories varchar(255),
        title varchar(255),
        PRIMARY KEY (id)
        ) $charset_collate;";

    // CREATE
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_tilelist_view);
}


?>
