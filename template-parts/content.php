<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php 
    if (!is_page()) {
        if ( is_singular() ) {
            the_title('<h1 class="post-title">', '</h1>');
        } else {
            the_title('<h2 class="post-title"><a href="' .esc_url( get_permalink() ).'">', '</a></h2>');
        }
    }

    if ( !is_single() AND !is_page() ) {
        echo '<p class="blog-post-meta">';
        echo '<time datetime="' . get_the_time("Y-m-d") . '">';
        echo get_the_time("Y-m-d") . '</time>';
        echo '</p>';
    } 
    
    if (is_search()) {
        the_excerpt();
    } else {
        the_content(); 
    }

    if ( !is_single() AND !is_page() ) {
        echo '<p class="blog-post-meta">category: ' . get_the_category_list(', ') . '<br />';
?>
        tags: <?php the_tags( '', ', ', '' ); ?></p>
<?php
    }

?>
</article> <!-- post -->