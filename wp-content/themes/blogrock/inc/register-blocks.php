<?php
add_action('acf/init', function () {
    if (!function_exists('acf_register_block_type')) return;

    $blocks = ['hero', 'subscription', 'latest-posts'];
    foreach ($blocks as $block) {
        include get_template_directory() . "/blocks/{$block}/register.php";
    }
});
