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
    <a  class="nav-link link-light <?php if (is_category('Software'))  echo 'active'; ?>" href="<?php echo get_category_link(get_cat_ID( 'Software' )); ?>">
        👩‍💻 Software
    </a>
</li>

<li class="nav-item">
    <a  class="nav-link link-light <?php if (is_page('about'))  echo 'active'; ?>" href="<?php echo site_url('/about'); ?>">
        ❓ About
    </a>
</li>