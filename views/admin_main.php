<?php

function kd_post_tiles_listview_admin_main_init()
{

    global $wpdb;
    require_once KD_POST_TILE_LISTVIEW_PLUGIN_PATH . 'includes/issets_admin_main.php';

    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';
    $allTiles           = $wpdb->get_results("SELECT * FROM " . $table_tilelist);

    $categories = get_categories(array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ));

    function getCetegorieOptions($categories, $selected = null)
    {

        $categorieOptions = "";

        if ($selected == null) {
            foreach ($categories as $category) {
                $categorieOptions .= '<option value="' . esc_html($category->term_id) . '">' . esc_html($category->name) . '</option>';
            }
            return $categorieOptions;
        }

        foreach ($categories as $category) {
            $isSelected = ($category->term_id == $selected) ? "selected" : "blubb";
            $categorieOptions .= '<option  ' .  $isSelected .  '  value="' . esc_html($category->term_id) . '">' . esc_html($category->name) . '</option>';
        }

        return $categorieOptions;
    }

    $categorieOptions = getCetegorieOptions($categories);


?>
    <section id="plugin-page">
        <div id="page-nav" class="box">
            <h1> <?php _e('KD Post Tile Listview', 'kd-post-tile-listview'); ?></h1>
            <div id="nav-menus">

            </div>
        </div>

        <div id="page-content">

            <h2><?php _e('New Listview Item', 'kd-post-tile-listview'); ?></h2>
            <form class="box listview-row" method="post">
                <div class="header">
                    <h2> <input type="text" placeholder="Title" name="tile-title"></h2>
                    <div class="listview-contextmenu">
                        <input type="submit" value="<?php _e('Create', 'kd-post-tile-listview'); ?>" name="createNewTileView" class="button-secondary">
                        <input type="submit" value="<?php _e('Cancel', 'kd-post-tile-listview'); ?>" name="" class="button-secondary">
                    </div>
                </div>

                <div class="">
                    <!--
                    <label for="tile-template-select">Tile List Template</label>
                    <select id="tile-template-select">
                        <option value="1">2 - 1 - 2</option>
                        <option value="2">2 - 2</option>
                    </select>
                    -->

                    <label for="tile-categorie-select"><?php _e('Category', 'kd-post-tile-listview'); ?></label>
                    <select id="tile-categorie-select" name="tile-categories">
                        <?php echo $categorieOptions ?>
                    </select>

                </div>
            </form>

            <h2><?php _e('All Listviews', 'kd-post-tile-listview'); ?></h2>

            <?php foreach ($allTiles as $tile) { ?>
                <form class="box listview-row" method="post">
                    <input type="hidden" name="tile-id" value="<?php echo $tile->id ?>">
                    <div class="header">
                        <h2> <input type="text" value="<?php echo $tile->title ?>" name="tile-title"> </h2>
                        <div class="listview-contextmenu">
                            <input type="submit" value="<?php _e('Save', 'kd-post-tile-listview'); ?>" name="save-tile" class="button-secondary">
                            <input type="submit" value="<?php _e('Delete', 'kd-post-tile-listview'); ?>" name="delete-tile" class="button-secondary">
                        </div>
                    </div>

                    <div>

                        <label for="tile-categorie-select_<?php echo $tile->id ?>"><?php _e('Category', 'kd-post-tile-listview'); ?></label>
                        <select id="tile-categorie-select_<?php echo $tile->id ?>" name="tile-categories">
                            <?php echo getCetegorieOptions($categories, $tile->categories) ?>
                        </select>

                    </div>

                    <h3>Shortcode</h3>
                    <code>
                        [tiles_portfolio id="<?php echo $tile->id ?>"]
                    </code>
                    <p><?php _e('Optionally you can limit the number of displayed tiles', 'kd-post-tile-listview'); ?></p>
                    <code>
                        [tiles_portfolio id="<?php echo $tile->id ?>" num="7"]
                    </code>
                </form>
            <?php } ?>


        </div>


    </section>

<?php
}


?>