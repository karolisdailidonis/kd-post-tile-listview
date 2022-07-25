<?php

function getCetegorieOptions( $categories, $selected = null ) {

    $categorieOptions = "";

    if ($selected == null) {
        foreach ($categories as $category) {
            $categorieOptions .= '<option value="' . esc_html($category->term_id) . '">' . esc_html($category->name) . '</option>';
        }
        return $categorieOptions;
    }

    foreach ($categories as $category) {
        $isSelected = ($category->term_id == $selected) ? "selected" : "";
        $categorieOptions .= '<option  ' .  $isSelected .  '  value="' . esc_html($category->term_id) . '">' . esc_html($category->name) . '</option>';
    }

    return $categorieOptions;
}


// Admin main init
function kd_post_tiles_listview_admin_main_init()
{
    global $wpdb;
    require_once KD_POST_TILE_LISTVIEW_PLUGIN_PATH . 'includes/issets_admin_main.php';

    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';
    $allTiles           = $wpdb->get_results( "SELECT * FROM " . $table_tilelist );

    $categories = get_categories(array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ));

    $categorieOptions = getCetegorieOptions($categories);
?>
    <section id="plugin-page">
        <div id="page-nav" class="box">
            <img id="logo" src="<?php echo KD_POST_TILE_LISTVIEW_PLUGIN_URL . 'assets/img/icon-256x256.png' ?>" alt="">
            <h1>KD - Post Tile Listview</h1>
            <div id="nav-menus">

            </div>
        </div>

        <div id="page-content">

            <h2><?php esc_html_e('New Listview Item', 'kd-post-tile-listview'); ?></h2>
            <form class="box listview-row" method="post">
                <div class="header">
                    <h2> <input type="text" placeholder="Title" name="tile-title"></h2>
                    <div class="listview-contextmenu">
                        <input type="submit" value="<?php esc_attr_e('Create', 'kd-post-tile-listview'); ?>" name="createNewTileView" class="button-secondary">
                        <input type="submit" value="<?php esc_attr_e('Cancel', 'kd-post-tile-listview'); ?>" class="button-secondary">
                    </div>
                </div>

                <div>
                    <label for="tile-categorie-select"><?php esc_html_e('Category', 'kd-post-tile-listview'); ?></label>
                    <select id="tile-categorie-select" name="tile-categories">
                        <?php echo wp_kses( $categorieOptions, array ('option' => array ( 'value' => array() )) )?>
                    </select>
                </div>
            </form>

            <h2><?php _e('All Listviews', 'kd-post-tile-listview'); ?></h2>

            <?php foreach ($allTiles as $tile) { ?>
                <form class="box listview-row" method="post">
                    <input type="hidden" name="tile-id" value="<?php echo esc_attr( $tile->id ) ?>">
                    <div class="header">
                        <h2> <input type="text" value="<?php echo esc_attr( $tile->title ) ?>" name="tile-title"> </h2>
                        <div class="listview-contextmenu">
                            <input type="submit" value="<?php esc_attr_e('Save', 'kd-post-tile-listview'); ?>" name="save-tile" class="button-secondary">
                            <input type="submit" value="<?php esc_attr_e('Delete', 'kd-post-tile-listview'); ?>" name="delete-tile" class="button-secondary">
                        </div>
                    </div>

                    <div>
                        <label for="tile-categorie-select_<?php echo esc_attr( $tile->id ) ?>"><?php esc_html_e('Category', 'kd-post-tile-listview'); ?></label>
                        <select id="tile-categorie-select_<?php echo esc_attr( $tile->id ) ?>" name="tile-categories">
                            <?php echo wp_kses( getCetegorieOptions( $categories, $tile->categories ), array ('option' => array ( 'value' => array() ))) ?>
                        </select>
                    </div>

                    <h3>Shortcode</h3>
                    <code>
                        [tiles_portfolio id="<?php echo esc_attr( $tile->id ) ?>"]
                    </code>
                    <p><?php _e('Optionally you can limit the number of displayed tiles', 'kd-post-tile-listview'); ?></p>
                    <code>
                        [tiles_portfolio id="<?php echo esc_attr( $tile->id ) ?>" num="7"]
                    </code>
                </form>
            <?php } ?>
        </div>

    </section>

<?php
}

?>