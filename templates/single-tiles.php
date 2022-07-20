<?php
get_header(); ?>

<article id="kd-tiles-post">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>

        <div id="kd-tiles-post-thumbnail">
            <?php wp_kses_post( the_post_thumbnail() ); ?>
        </div>

        <header>
            <h1><?php esc_html(the_title()); ?></h1>
            <hr>
        </header>

        <div id="kd-tiles-post-content">
            <?php wp_kses_post( the_content() ); ?>
        </div>

        <?php
            
        } // end while
    } // end if
        ?>

</article>

<?php get_footer(); ?>