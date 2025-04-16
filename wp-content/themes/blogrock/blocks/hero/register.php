<?php
acf_register_block_type([
    'name' => 'hero',
    'title' => __('Hero Block'),
    'render_template' => 'blocks/hero/hero.php',
    'category' => 'layout',
    'icon' => 'cover-image',
    'mode' => 'edit',
    'supports' => ['align' => false],
]);
