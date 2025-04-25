<?php

acf_register_block_type([
    'name' => 'subscription',
    'title' => __('Subscription Form'),
    'description' => __('A custom block for newsletter subscriptions'),
    'render_template' => get_template_directory() . '/blocks/subscription/subscription.php',
    'category' => 'formatting',
    'icon' => 'email',
    'mode' => 'edit',
    'keywords'        => ['subscribe', 'newsletter'],
]);
