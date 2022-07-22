</main>

<footer class="text-center text-lg-start bg-light text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <div class="me-5 d-none d-lg-block">
      <span><a href="#"><span>Back to top </span><span class="arrow" aria-hidden="true">&uarr;</span></a></span>
    </div>
    <div><!-- Right --></div>
  </section>
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <?php
            if( isset( get_nav_menu_locations()['footerMenuLocation'] ) && wp_get_nav_menu_items(get_nav_menu_locations()['footerMenuLocation']) ) { ?>
                <h6 class="text-uppercase fw-bold mb-4">
                Useful Links
                </h6>
            <?php
                    wp_nav_menu(array(
                        'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                        'theme_location' => 'footerMenuLocation'
                    ));
                }
            ?>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>

  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    &copy; <?php echo date_i18n('Y'); ?>, <a class="text-reset" href="<?php echo site_url(); ?>">James North</a>
  </div>
</footer>



<?php wp_footer(); ?>
</body>
</html>
