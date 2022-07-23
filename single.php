<?php get_header(); theme_dbg_show_filename(__FILE__); ?>

<?php

    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content', get_post_type());
    }

    get_footer();
?>