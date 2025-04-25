<?php get_template_part('layout/header'); ?>

<main class="container mx-auto px-4 py-16">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/content', 'single'); ?>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
