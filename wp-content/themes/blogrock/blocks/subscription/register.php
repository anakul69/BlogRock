<?php
acf_register_block_type([
    'name' => 'subscription',
    'title' => __('Subscription Form'),
    'render_template' => 'blocks/subscription/subscription.php',
    'category' => 'layout',
    'icon' => 'email',
    'mode' => 'edit',
]);
