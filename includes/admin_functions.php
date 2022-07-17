<?php
function kd_tiles_portfolio_setup_menu()
{
    add_menu_page('Tile Listview', 'Tile Listview', 'edit_posts', 'kd-tiles-portfolio-plugin', 'kd_post_tiles_listview_admin_main_init', '', 9);
}

function kd_post_tile_listview_admin_css_js()
{
    wp_enqueue_style('kd_tile_portfolio_admin_style', KD_POST_TILE_LISTVIEW_PLUGIN_URL . 'assets/css/admin-style.css');
}

?>