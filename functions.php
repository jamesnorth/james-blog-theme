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

?>