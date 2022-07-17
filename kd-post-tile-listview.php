<?php
/**
 * Plugin Name: KD Post Tile Listview
 * Author: Karolis Dailidonis
 * Author URI: https://karolisdailidonis.de
 * Plugin URI: https://karolisdailidonis.de/developments/kd-post-tile-listview
 * Version: 0.2.0
 * Requires at least: 6.0
 * Requires PHP: 7.0
 * License: GNUGPLv3
 * Description: A listview in tiles format for posts
 **/

if (!defined('ABSPATH')) {
    exit;
}

define('KD_TILE_PORTFOLIO_PLUGIN_URL', plugin_dir_url(__FILE__));
define('KD_TILE_PORTFOLIO_PLUGIN_PATH', plugin_dir_path(__FILE__));

if (!defined('KD_TILE_PORTFOLIO_FILE'))
    define('KD_TILE_PORTFOLIO_FILE', __FILE__);

if (!defined('KD_TILE_PORTFOLIO_DIR'))
    define('KD_TILE_PORTFOLIO_DIR', dirname(KD_TILE_PORTFOLIO_FILE));

    
// ADMIN Functions
if ( is_admin() ) {
    require_once KD_TILE_PORTFOLIO_PLUGIN_PATH . 'includes/install.php';
    require_once KD_TILE_PORTFOLIO_PLUGIN_PATH . 'includes/uninstall.php';
    require_once KD_TILE_PORTFOLIO_PLUGIN_PATH . 'includes/admin_functions.php';
    require_once KD_TILE_PORTFOLIO_PLUGIN_PATH . 'views/admin_main.php';
    
    register_activation_hook(__FILE__, 'kd_tiles_portfolio_activate');

    add_action('admin_menu', 'kd_tiles_portfolio_setup_menu');
    add_action('admin_enqueue_scripts', 'kd_post_tile_listview_admin_css_js');
    
    add_filter('theme_post_templates', 'kd_post_tile_listview_templates');
    add_filter('template_include', 'kd_post_tile_listview_change_templates', 99);
}


// PUBLIC Functions
require_once KD_TILE_PORTFOLIO_PLUGIN_PATH . 'includes/shortcodes.php';
add_shortcode('tiles_portfolio', 'kd_post_tile_listview_shortcode');


?>