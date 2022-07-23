<?php get_header(); ?>

<?php
    $i = 0;

    while (have_posts()) {
        $i++;
        if ($i > 1) {
            echo '<hr class="post-separator" aria-hidden="true" />';
        }
    
        the_post(); 

        get_template_part('template-parts/content', get_post_type());
    }

    echo paginate_links();
    echo "<p>&nbsp;</p>";
?>

<?php get_footer(); ?>