<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php 
    if (!is_page()) {
        if ( is_singular() ) {
            the_title('<h1 class="post-title">', '</h1>');
        } else {
            the_title('<h2 class="post-title"><a href="' .esc_url( get_permalink() ).'">', '</a></h2>');
        }
    }

    if ( !is_page() ) {
        echo '<p class="blog-post-meta">Posted ';
        echo '<time datetime="' . get_the_time("Y-m-d") . '">';
        echo get_the_time("Y-m-d") . '</time>';
        echo ' in ';
        echo get_the_category_list(', ');
        echo '</p>';
    } 
    
    if (is_search()) {
        the_excerpt();
    } else {
        the_content(); 
    }

    if ( !is_page() ) {
        $tags = get_the_tags();
        if ( $tags ) {
            foreach ( $tags as $tag ) : ?>
                <span class="badge rounded-pill bg-primary text-light">
                <i class="bi bi-tag"></i>&nbsp;<a class="link-light text-decoration-none" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" rel="tag">
                <?php echo esc_html( $tag->name ); ?>&nbsp;&nbsp;</a>
                </span>
            <?php endforeach;
        }
    }


?>
</article> <!-- post -->