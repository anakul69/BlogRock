<?php
require_once get_template_directory() . '/inc/acf.php';

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'blogrock-style',
        get_template_directory_uri() . '/dist/style.css',
        [],
        filemtime(get_template_directory() . '/dist/style.css')
    );
    wp_enqueue_script(
        'blogrock-js',
        get_template_directory_uri() . '/dist/bundle.js',
        [],
        filemtime(get_template_directory() . '/dist/bundle.js'),
        true
    );
});

