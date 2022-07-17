<?php
/**
 * Change the page template to the selected template on the dropdown
 */
function kd_post_tile_listview_change_templates($template)
{
    if (is_single()) {
        $meta = get_post_meta(get_the_ID());

        if (!empty($meta['_wp_page_template'][0]) && $meta['_wp_page_template'][0] != $template) {
            $template = $meta['_wp_page_template'][0];
            wp_enqueue_style('kd_post_tile_listview_template_style', KD_POST_TILE_LISTVIEW_PLUGIN_URL . 'templates/assets/single-tiles.css');
        }
    }

    return $template;
}

function kd_post_tile_listview_textdomain($mofile, $domain)
{
    if ('kd-post-tile-listview' == $domain) {
        $locale = apply_filters('plugin_locale', determine_locale(), $domain);
        $mofile = KD_POST_TILE_LISTVIEW_PLUGIN_PATH . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}

?>