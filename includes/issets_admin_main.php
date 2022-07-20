<?php

if (isset($_POST['createNewTileView'])) {

    global $wpdb;
    $table_tilelist = $wpdb->prefix . 'kd_tilelist_views';

    $data   = array(
        'categories'    => sanitize_text_field( $_POST['tile-categories'] ), 
        'title'         => sanitize_text_field( $_POST['tile-title'] ),
    );

    $format = array('%s', '%s');
    $wpdb->insert( $table_tilelist, $data, $format );

}

if (isset($_POST['delete-tile'])) {
    global $wpdb;
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';

    $wpdb->delete( $table_tilelist, array('id' => sanitize_text_field( $_POST['tile-id']) ));
}

if (isset($_POST['save-tile'])) {
    global $wpdb;
    $table_tilelist     = $wpdb->prefix . 'kd_tilelist_views';

    $wpdb->update( 
        $table_tilelist,
        // DATA
        array( 
            'title'         => sanitize_text_field( $_POST['tile-title'] ), 
            'categories'    => sanitize_text_field( $_POST['tile-categories'] )
        ),
        // WHERE 
        array(
            'id' => sanitize_text_field( $_POST['tile-id'] )
        )
    );
}


?>