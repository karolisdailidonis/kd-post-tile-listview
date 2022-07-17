<?php
function kd_post_tile_listview_shortcode($atts)
{
    wp_enqueue_style('kd_tile_portfolio_style', KD_TILE_PORTFOLIO_PLUGIN_URL . 'style.css');

    global $wpdb;
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';

    //Attributes
    $atts = shortcode_atts(
        array(
            'num' => -1,
            'id' => -1
        ),
        $atts,
        'tiles_portfolio'
    );

    if ($atts['id'] == -1) return "Keine ID im Shortcode mitgegeben";

    $tile = $wpdb->get_row("SELECT * FROM " . $table_tilelist . " WHERE id = " . $atts['id']);

    if (empty($tile)) return "Ungütlige ID";

    // the query
    $the_query = new WP_Query(
        array(
            'posts_per_page' => $atts['num'],
            'cat' => $tile->categories,
        )
    );

    ob_start();
?>
    <div class="tile-list">
        <?php
        if ($the_query->have_posts()) :
            $count = 1;
            while ($the_query->have_posts()) : $the_query->the_post();
                $post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'names'));
                $categories = '';
                if ($post_categories) { // Always Check before loop!
                    foreach ($post_categories as $name) {
                        $categories .= $name . ' ';
                    }
                }


        ?>
                <a class="tile <?php echo ($count % 3 == 0) ? "full" : "half" ?>" href="<?php echo get_permalink(); ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                    <div class="backgroundcolor"></div>

                    <div class="head">
                        <h3><?php the_title(); ?></h3>
                        <span class="category"> <?php #echo $categories ?> </span>
                    </div>

                    <div class="link">
                        <span>Anschauen</span>
                        <span>➜</span>
                    </div>
                </a>
        <?php
                $count++;
            endwhile;
        else :
        endif;
        ?>
    </div>
<?php

    return ob_get_clean();
}

?>