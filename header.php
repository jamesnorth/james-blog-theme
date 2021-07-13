<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');  ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
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
                            $chinese_categories = array('Mandarin Chinese', 'Writing Practice');
                            if (is_category($chinese_categories) or is_page('chinese-resources'))
                                $css_class = 'active';
                            else
                                $css_class = '';
                        ?>
                        <a class="nav-link dropdown-toggle link-light <?php echo $css_class; ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">🇨🇳 Mandarin Chinese</a>  
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo get_category_link(get_cat_ID( 'Writing Practice' )); ?>" class="dropdown-item">Writing Practice</a></li>
                            <li><a href="<?php echo site_url('/chinese-resources'); ?>" class="dropdown-item">Chinese Resources</a></li>
                        </ul>

                    
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
    <header class="py-3 bg-light border-bottom mb-4">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
        <span class="fs-4"><?php 
            if (is_page()) {
                the_title(); 
            } else if (is_single()) {
                echo 'Blog post';
            } else if (is_category()) {
                echo single_cat_title();
            } else if (is_tag()) {
                echo single_tag_title('tag: ');
            } else if (is_search()) {
                echo 'Search';
            } else if (is_author()) {
                echo 'James North';
            } else if (get_post_type() == 'chineseword') {
                echo 'Chinese Word';
            } else if (is_404()) {
                echo 'Page Not found';
            } else {
                echo 'Latest posts';
            }
        ?></span>
        </a>
        
    </div>
    </header>
    <main role="main" class="container">