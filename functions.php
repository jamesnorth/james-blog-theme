<?php

/**
 * Load CSS and Javascript dependencies
 */
function james_blog_files() {
    $theme_version = wp_get_theme()->get( 'Version' );
    
    wp_enqueue_style( 'jrn-style', get_stylesheet_uri(), array(), $theme_version );
    wp_enqueue_style('bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', NULL, '1.0', true);
    wp_enqueue_style('bootstrap-icon', '//cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css');
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
    $page_title = '';

    if (is_page()) {
        $page_title = get_the_title(); 
    } else if (is_single()) {
        $page_title = 'Blog post';
    } else if (is_category()) {        
        $page_title = single_cat_title('', false);
    } else if (is_tag()) {
        $page_title = single_tag_title('tag: ');
    } else if (is_search()) {
        $page_title = 'Search';
    } else if (is_author()) {
        $page_title = 'James North';
    } else if (get_post_type() == 'chineseword') {
        $page_title = 'Chinese Word';
    } else if (is_404()) {
        $page_title = 'Page Not found';
    } else {
        $page_title = 'Latest posts';
    }

    $page_title = apply_filters( 'jrn_get_page_title', $page_title, null );
    return $page_title;
}

/**
 * a debug function that prints an HTML comment with the filename
 * of the theme file being used to render the page.
 * 
 * This works by using PHP backtraces to dynamically extract the file we're
 * interested in, however it currently does this by looking at the 5th index
 * of the backtrace. If WP ever changes it's likely this function would break.
 * 
 * A more reliable method of doing this should be found. I think a list of WP
 * theme files should be used to search the backtrace to figure out which one
 * called "get_header()".
 */
add_action('get_header', 'theme_dbg_show_filename');
function theme_dbg_show_filename($filename) {
    $backtrace =  debug_backtrace();
    $filename = $backtrace[4]['file']; // TODO: find somehting more reliable than this
    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        echo '<!-- file: ' . basename($filename) . ' -->';
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

/**
 * Taken from: https://wordpress.stackexchange.com/questions/252328/wordpress-4-7-1-rest-api-still-exposing-users
 * 
 * Wrap an existing default callback passed in parameter and create
 * a new permission callback introducing preliminary checks and
 * falling-back on the default callback in case of success.
 */
function permission_callback_hardener ($existing_callback) {
    return function ($request) use($existing_callback) {
        if (! current_user_can('list_users')) {
            return new WP_Error(
                'rest_user_cannot_view',
                __( 'Sorry, you are not allowed to access users.' ),
                [ 'status' => rest_authorization_required_code() ]
            );
        }

        return $existing_callback($request);
    };
}

function api_users_endpoint_force_auth($endpoints)
{
    $users_get_route = &$endpoints['/wp/v2/users'][0];
    $users_get_route['permission_callback'] = permission_callback_hardener($users_get_route['permission_callback']);

    $user_get_route = &$endpoints['/wp/v2/users/(?P<id>[\d]+)'][0];
    $user_get_route['permission_callback'] = permission_callback_hardener($user_get_route['permission_callback']);

    return $endpoints;
}

add_filter('rest_endpoints', 'api_users_endpoint_force_auth');

?>