<?php

if (isset($_POST['createNewTileView'])) {

    global $wpdb;
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';

    $tileCategorie  = $_POST['tile-categories'];
    $tileTitle      = $_POST['tile-title'];

    $data   = array('categories' => $tileCategorie, 'title' => $tileTitle);
    $format = array('%s', '%s');
    $wpdb->insert($table_tilelist, $data, $format);

}

if (isset($_POST['delete-tile'])) {
    global $wpdb;
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';

    $wpdb->delete( $table_tilelist, array('id' => $_POST['tile-id']) );
}

if (isset($_POST['save-tile'])) {
    global $wpdb;
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';

    $wpdb->update( 
        $table_tilelist,
        // DATA
        array( 
            'title'         => $_POST['tile-title'], 
            'categories'    => $_POST['tile-categories'] 
        ),
        // WHERE 
        array(
            'id' => $_POST['tile-id']
        )
    );
}


?>