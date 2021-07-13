<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php 
    $traditional_chinese = get_field('traditional_chinese');

    if ( is_singular() ) {
        echo '<h1 class="post-title">';
        echo get_the_title();
        if ($traditional_chinese) {
            echo ' (' . $traditional_chinese . ')';
        }
        echo '</h1>';
    } else {
        echo '<h2 class="post-title"><a href="' .esc_url( get_permalink() ).'">';
        echo get_the_title();
        if ($traditional_chinese) {
            echo ' (' . $traditional_chinese . ')';
        }
        echo '</a></h2>';
    }
    
    $pinyin = get_field('pinyin');
    echo '<p>PY: ' . pinyinise($pinyin) . '</p>';
    the_content();
?>
</article> <!-- post -->