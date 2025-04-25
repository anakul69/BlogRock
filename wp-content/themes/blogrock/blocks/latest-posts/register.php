<?php
acf_register_block_type([
    'name' => 'latest-posts',
    'title' => 'Latest Blog Posts',
    'render_template' => get_template_directory() . '/blocks/latest-posts/latest-posts.php',
    'category' => 'formatting',
    'icon' => 'admin-post',
    'keywords' => ['latest', 'blog', 'posts'],
    'supports' => ['align' => false],
]);

