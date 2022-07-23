<?php get_header(); ?>

<form class="form-inline d-flex justify-content-center md-form form-sm mt-0" method="get" action="<?php echo esc_url(site_url('/')); ?>">
    <input class="form-control form-control-sm mr-3 w-75" placeholder="search" id="s" type="search" name="s" value="<?php echo get_search_query(); ?>" />
    <button class="btn btn-primary" type="submit" value="Search">
        <i class="fas fa-search" aria-hidden="true"></i><span> Search</span>
    </button>
</form>
</p>&nbsp;</p>

<?php
    $i = 0;

    if (have_posts()) {
        echo '<h2>Search results for &ldquo;' . get_search_query() . '&rdquo;</h2>';

        while (have_posts()) {
            $i++;
            if ($i > 1) {
                echo '<hr class="post-separator" aria-hidden="true" />';
            }
        
            the_post(); 

            get_template_part('template-parts/content', get_post_type());
        }

        echo paginate_links();
    } else {
        echo '<h2>No search results for &ldquo;' . get_search_query() . '&rdquo;</h2>';
    }
?>

<?php get_footer(); ?>