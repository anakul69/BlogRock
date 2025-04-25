<?php get_template_part('layout/header'); ?>

<main class="content-area">
    <div class="mx-auto px-10 2xl:px-[135px]">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
