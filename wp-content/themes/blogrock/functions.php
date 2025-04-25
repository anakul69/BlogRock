<?php

require_once get_template_directory() . '/inc/acf.php';

add_theme_support('post-thumbnails');

add_action('wp_enqueue_scripts', function () {
    $dist = get_template_directory() . '/dist';

    wp_enqueue_style(
        'blogrock-style',
        get_template_directory_uri() . '/dist/style.css',
        [],
        file_exists("$dist/style.css") ? filemtime("$dist/style.css") : null
    );

    wp_enqueue_script(
        'blogrock-js',
        get_template_directory_uri() . '/dist/bundle.js',
        [],
        file_exists("$dist/bundle.js") ? filemtime("$dist/bundle.js") : null,
        true
    );

    wp_enqueue_script(
        'blogrock-header',
        get_template_directory_uri() . '/dist/header.js',
        ['blogrock-js'],
        file_exists("$dist/header.js") ? filemtime("$dist/header.js") : null,
        true
    );

    wp_localize_script(
        'blogrock-js',
        'blogrock',
        ['ajax_url' => admin_url('admin-ajax.php')]
    );
});

add_action('acf/init', function () {
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $blocks_dir = get_template_directory() . '/blocks/';
    foreach (glob($blocks_dir . '*', GLOB_ONLYDIR) as $dir) {
        $register = "$dir/register.php";
        if (file_exists($register)) {
            require $register;
        }
    }
});

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Site Settings',
        'menu_title' => 'Site Settings',
        'menu_slug'  => 'site-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ]);
}

register_nav_menus([
    'main_menu'   => __('Main Menu', 'blogrock'),
    'footer_menu' => __('Footer Menu', 'blogrock'),
]);

add_action('wp_ajax_live_search', 'blogrock_live_search');
add_action('wp_ajax_nopriv_live_search', 'blogrock_live_search');

function blogrock_live_search() {
    $query   = empty($_GET['s']) ? '' : sanitize_text_field($_GET['s']);
    $results = [];

    if ($query) {
        $posts = get_posts([
            's'              => $query,
            'post_type'      => ['post', 'page'],
            'posts_per_page' => 5,
        ]);

        foreach ($posts as $post) {
            $results[] = [
                'title' => get_the_title($post),
                'link'  => get_permalink($post),
                'type'  => get_post_type($post),
            ];
        }
    }

    wp_send_json($results);
}

add_action('enqueue_block_assets', function () {
    if (is_admin()) {
        return;
    }

    foreach (glob(get_template_directory() . '/blocks/*', GLOB_ONLYDIR) as $dir) {
        $name   = basename($dir);
        $script = "$dir/$name.js";

        if (file_exists($script)) {
            wp_enqueue_script(
                "block-$name",
                get_template_directory_uri() . "/blocks/$name/$name.js",
                [],
                filemtime($script),
                true
            );
        }
    }
});

add_action('wp_ajax_subscription_form', 'blogrock_handle_subscription');
add_action('wp_ajax_nopriv_subscription_form', 'blogrock_handle_subscription');

function blogrock_handle_subscription() {
    $email = empty($_POST['email']) ? '' : sanitize_email($_POST['email']);

    if (!is_email($email)) {
        wp_send_json(['success' => false, 'message' => 'Invalid email']);
    }

    $sent = wp_mail(
        'anatolii.kulinich@gmail.com',
        'New Subscription',
        "Subscriber Email: $email"
    );

    wp_send_json(['success' => (bool) $sent]);
}

add_action('init', function () {
    register_post_type('article', [
        'labels' => [
            'name'          => __('Articles'),
            'singular_name' => __('Article'),
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'articles'],
        'menu_icon'    => 'dashicons-media-document',
        'menu_position'=> 5,
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
    ]);
});
