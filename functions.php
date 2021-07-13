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


/*** MOVE THIS!!!! ****/

$tone_marks = array(
    'a' => array('ā', 'á', 'ǎ', 'à', 'a'), 
    'A' => array('Ā', 'Á', 'Ǎ', 'À', 'A'),
    'e' => array('ē', 'é', 'ě', 'è', 'e'), 
    'E' => array('Ē', 'É', 'Ě', 'È', 'E'),
    'i' => array('ī', 'í', 'ǐ', 'ì', 'i'), 
    'I' => array('Ī', 'Í', 'Ǐ', 'Ì', 'I'),
    'o' => array('ō', 'ó', 'ǒ', 'ò', 'o'), 
    'O' => array('Ō', 'Ó', 'Ǒ', 'Ò', 'O'),
    'u' => array('ū', 'ú', 'ǔ', 'ù', 'u'), 
    'U' => array('Ū', 'Ú', 'Ǔ', 'Ù', 'U'),
    'v' => array('ǖ', 'ǘ', 'ǚ', 'ǜ', 'ü'), 
    'V' => array('Ǖ', 'Ǘ', 'Ǚ', 'Ǜ', 'Ü'),
);
$tone_marks_umlaut = array(
    'u' => array('ǖ', 'ǘ', 'ǚ', 'ǜ', 'ü'),
    'U' => array('Ǖ', 'Ǘ', 'Ǚ', 'Ǜ', 'Ü'),
);

function get_pinyin($letter, $tone, $umlaut=false) {
    global $tone_marks, $tone_marks_umlaut;

    if ($umlaut) {
        return $tone_marks_umlaut[$letter][$tone - 1];
    }
    return $tone_marks[$letter][$tone - 1];
}

/**
 * 
 */
function pinyinise_single_word($syllable, $tone, $umlaut=false) {
    $aore = array();
    $ou = array();
    $vowels = array_intersect(str_split($syllable), array('A','E','I','O','U','a','e','i','o','u'));
    $last_vowel = array_pop($vowels);

    if (preg_match('/[ae]+/', $syllable, $aore)) {
        return str_replace($aore[0], get_pinyin($aore[0], $tone, $umlaut), $syllable);
    }

    if (preg_match('/(.*)ou/', $syllable, $ou)) {
        return str_replace('ou', get_pinyin('o', $tone, $umlaut) . 'u', $syllable);
    }

    $tone_mark = get_pinyin($last_vowel, $tone, $umlaut);
    $last_vowel_pos = strripos($syllable, $last_vowel);
    return substr($syllable, 0, $last_vowel_pos) . $tone_mark . substr($syllable, $last_vowel_pos + 1);
}

/**
 * Convert numbered pinyin to pinyin with tone marks
 */
function pinyinise($numbered) {
    $words = array();
    preg_match_all('/([A-Za-z]+)(:?)([1-5]+)/', $numbered, $words, PREG_SET_ORDER);
    $pinyin = '';
    foreach ($words as $word) {
        $syllable = $word[1];
        $tone = $word[3];
        $umlaut = $word[2] === ':';

        $pinyin .= ' ' . pinyinise_single_word($syllable, $tone, $umlaut);
    }

    return $pinyin;
}

?>