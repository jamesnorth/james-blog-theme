<div class="row>">
<div class="col-lg-8 col-md-10 mx-auto">
<?php
if (have_posts()) {
    $post_counter = 0;
    while (have_posts()) {
        // After the first post we want to include a horizontal separator
        if (++$post_counter > 1) {
            echo '<hr class="post-separator" aria-hidden="true" />';
        }
    
        the_post(); 
        get_template_part('template-parts/content', get_post_type());
    }

    // output the pagination links
    echo paginate_links();
    echo "<p>&nbsp;</p>";
} else {
    echo '<h1>Nothing here yet.</h1>';
}
?>
</div> <!-- col -->
</div> <!-- row -->