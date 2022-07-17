<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$table_tilelist = $wpdb->prefix . 'kd_tilelist_views';

$wpdb->query("DROP TABLE IF EXISTS {$table_tilelist}");
?>