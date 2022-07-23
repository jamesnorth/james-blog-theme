<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php bloginfo( 'name' ); ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'headerMenuLocation',
                    'container' => null,
                    'menu_class' => 'navbar-nav me-auto mb-2 mb-lg-0',
                    'item_spacing' => 'preserve',
                    'fallback_cb' => 'jrn_default_menu',
                    'walker' => new Bootstrap_Nav_Menu()
                ));
            ?>
 
            </ul>
            <form class="d-flex" method="get" action="<?php echo esc_url(site_url('/')); ?>">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="s">
            </form>
        </div>
    </div>
</nav>
