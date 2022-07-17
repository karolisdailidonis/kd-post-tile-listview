<?php
get_header(); ?>

<article id="kd-tiles-post">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>

        <div id="kd-tiles-post-thumbnail">
            <?php the_post_thumbnail();  ?>
        </div>

        <header>
            <h1><?php the_title(); ?></h1>
            <hr>
        </header>

        <div id="kd-tiles-post-content">
            <?php the_content(); ?>
        </div>

        <?php
            
        } // end while
    } // end if
        ?>

</article>

<?php get_footer(); ?>