<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head class="bg-white py-4">
    <?php wp_head(); ?>
    <div class="container mx-auto flex justify-between items-center">
        <?php if ($logo = get_field('site_logo', 'option')): ?>
            <a href="<?= esc_url(home_url('/')); ?>">
                <img src="<?= esc_url($logo['url']); ?>" alt="<?= esc_attr($logo['alt']); ?>" class="h-10">
            </a>
        <?php endif; ?>

        <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container' => false,
            'menu_class' => 'flex space-x-6 text-sm font-semibold',
        ]);
        ?>
    </div>
</head>

<body <?php body_class(); ?>>
