<?php 

function chinese_header_title($page_title) {
    return '🇨🇳 Mandarin Chinese';
}
add_filter('jrn_get_page_title', 'chinese_header_title');

get_header(); 
?>

<?php
get_template_part('template-parts/list_posts');
?>

<?php get_footer(); ?>