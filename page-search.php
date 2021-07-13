<?php
    get_header(); 

    while (have_posts()) {
        the_post();

        ?>

        <form class="form-inline d-flex justify-content-center md-form form-sm mt-0" method="get" action="<?php echo esc_url(site_url('/')); ?>">
            <input class="form-control form-control-sm mr-3 w-75" placeholder="search" id="s" type="search" name="s" />
            <button class="btn btn-primary" type="submit" value="Search">
                <i class="fas fa-search" aria-hidden="true"></i>
            </button>
        </form>
        </p>&nbsp;</p>
<?php
        
        get_template_part('template-parts/content', get_post_type());
    }

    get_footer();
?>