<?php
acf_register_block_type([
    'name' => 'hero',
    'title' => 'Hero Block',
    'description' => 'Hero Block',
    'render_template' => get_template_directory() . '/blocks/hero/hero.php',
    'category' => 'layout',
    'icon' => 'cover-image',
    'mode' => 'edit',
    'supports' => ['align' => false]
]);
