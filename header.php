<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');  ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php get_template_part('template-parts/navbar'); ?>

    <header class="py-3 bg-light border-bottom mb-4">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <span class="fs-4"><?php jrn_get_page_title(); ?></span>
        </a>
    </div>
    </header>
    <main role="main" class="container">