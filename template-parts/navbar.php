<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo site_url(); ?>">James North</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link-light <?php if (is_home()) echo 'active'; ?>" href="<?php echo site_url(); ?>">
                        🏠 Home
                    </a>
                </li>
        
                <li class="nav-item dropdown">
                    <?php
                        $language_categories = array('Mandarin Chinese', 'Tagalog');
                        if (is_category($language_categories) or is_page('chinese-resources'))
                            $css_class = 'active';
                        else
                            $css_class = '';
                    ?>

                    <a class="nav-link dropdown-toggle link-light <?php echo $css_class; ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">🌏 Languages</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo get_category_link(get_cat_ID( 'Mandarin Chinese' )); ?>" class="dropdown-item">🇨🇳 Mandarin Chinese</a></li>
                        <li><a href="<?php echo get_category_link(get_cat_ID( 'Tagalog' )); ?>" class="dropdown-item">🇵🇭 Tagalog</a></li>
                        <li><a href="<?php echo site_url('/chinese-resources'); ?>" class="dropdown-item">Chinese Resources</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a  class="nav-link link-light <?php if (is_category('Retro Computers'))  echo 'active'; ?>" href="<?php echo get_category_link(get_cat_ID( 'Retro Computers' )); ?>">
                        💾 Retro Computers
                    </a>
                </li>

                <li class="nav-item">
                    <a  class="nav-link link-light <?php if (is_category('Software'))  echo 'active'; ?>" href="<?php echo get_category_link(get_cat_ID( 'Software' )); ?>">
                        👩‍💻 Software
                    </a>
                </li>
                
                <li class="nav-item">
                    <a  class="nav-link link-light <?php if (is_page('about'))  echo 'active'; ?>" href="<?php echo site_url('/about'); ?>">
                        ❓ About
                    </a>
                </li>
            </ul>
            <form class="d-flex" method="get" action="<?php echo esc_url(site_url('/')); ?>">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="s">
            </form>
        </div>
    </div>
</nav>
