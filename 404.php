<?php get_header(); ?>

<div class="container d-flex justify-content-center">
    <div class="row">
        <div class="col-3">
            <p style="font-size: 132px">😱</p>
        </div>
        <div class="col">
            <h2 class="display-6">Sorry, the page you are looking for could not be found.</h2>
            <p>&nbsp;</p>
            <h2 class="display-6">It may have been moved, deleted, or may not exit.</h2>
            </h2>
        </div>
    </div> <!-- row -->
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>

<!-- search form -->
<div class="container mt-5">
    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0" method="get" action="<?php echo esc_url(site_url('/')); ?>">
        <input class="form-control form-control-sm mr-3 w-75" placeholder="search" id="s" type="search" name="s" value="<?php echo get_search_query(); ?>" />
        <button class="btn btn-primary" type="submit" value="Search">
            <i class="fas fa-search" aria-hidden="true"></i><span> Search</span>
        </button>
    </form>
</div>
<p>&nbsp;</p>
<?php get_footer(); ?>