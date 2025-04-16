<?php
acf_register_block_type([
    'name' => 'latest-posts',
    'title' => __('Latest Blog Posts'),
    'render_template' => 'blocks/latest-posts/latest-posts.php',
    'category' => 'layout',
    'icon' => 'admin-post',
    'mode' => 'preview',
]);
