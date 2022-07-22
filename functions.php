<?php

/**
 * Load CSS and Javascript dependencies
 */
function james_blog_files() {
    $theme_version = wp_get_theme()->get( 'Version' );
    
    wp_enqueue_style( 'jrn-style', get_stylesheet_uri(), array(), $theme_version );
    
    wp_enqueue_style('bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', NULL, '1.0', true);
    wp_enqueue_script('font-awesome', '//kit.fontawesome.com/2bc682a768.js',  NULL, '1.0', true);

}
add_action('wp_enqueue_scripts', 'james_blog_files');

/**
 * Setup theme support
 */
function james_theme_support() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocation', 'Footer Menu Location');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_theme_support(
		'html5',
        array(
            'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
        )
    );
}
add_action( 'after_setup_theme', 'james_theme_support' );

/**
 * Remove wordpress version metadata from the HTML head section
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * add customised styles for the login page
 */
function jrn_enqueue_login_styles() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css');

    // need to adjust the URL to the image, so here we use wp_add_inline_style() to correct
    // the URL after including the CSS file.
    $style = 'body.login { background-image: url("{theme_url}/images/login_bg.jpg") !important; background-position: center; }';
    $data = str_replace( '{theme_url}', get_template_directory_uri(), $style );
    wp_add_inline_style( 'custom-login', $data );
}
add_action( 'login_enqueue_scripts', 'jrn_enqueue_login_styles' );

/**
 * Wordpress tells you if you have entered an incorrect password, or have an incorrect
 * username, this is generally considered bad for security. So here we override this
 * behaviour so that the error given is unclear.
 */
function jrn_login_errors() {
    return 'Incorrect username, or password';
}
add_filter( 'login_errors', 'jrn_login_errors' );

/**
 * echos out the title for a given page based on the page type.
 */
function jrn_get_page_title() {
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
}

/**
 * fallback function used by wp_nav_menu
 * 
 * If no menu is set, then this function will output a default menu.
 */
function jrn_default_menu($args = array()) {
    if (isset( $args->echo ) && false === $args->echo ) {
        return file_get_contents(locate_template("template-parts/default_menu.php"));
    } else {
        get_template_part('template-parts/default_menu');
    }
}

/**
 * This is used to implement the nested nav menu using Bootstrap
 */
class Bootstrap_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth=0, $args=null) {
        if ($depth == 0) {
            $output .= '<ul class="dropdown-menu">';
        }
    }

    function start_el(&$output, $menu_item, $depth=0, $args=null, $id=0) {
        $item_output = isset( $args->before ) ? $args->before : '';

        if (in_array('menu-item-has-children', $menu_item->classes) == true) {
            $item_output .= '<li class="nav-item dropdown">';
            $item_output .= '<a class="nav-link dropdown-toggle link-light" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">';
        } else {
            if ($depth == 1) {
                $item_output .= '<li><a href="' . $menu_item->url . '" class="dropdown-item">';
            } else {
                $item_output .= '<li class="' . implode(' ', $menu_item->classes) . ' nav-item">';
                $item_output .= '<a class="nav-link link-light" href="' . $menu_item->url . '">';
            }
        }

        $item_output .= $menu_item->title . '</a>';

        $item_output .= isset( $args->after ) ? $args->after : '';

        $output .= apply_filters( 'jrn_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
    }
}

?>