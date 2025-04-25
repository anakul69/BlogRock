<article <?php post_class('max-w-4xl mx-auto'); ?>>

    <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
        <a href="<?= esc_url(home_url()); ?>" class="hover:underline">Home</a>
        <span class="mx-2">/</span>
        <span><?php the_title(); ?></span>
    </nav>

    <header class="mb-6">
        <h1 class="text-4xl md:text-5xl font-bold text-text-base leading-tight"><?php the_title(); ?></h1>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <figure class="mb-8">
            <?php the_post_thumbnail('full', ['class' => 'w-full h-auto rounded-xl']); ?>
        </figure>
    <?php endif; ?>

    <section class="prose prose-lg max-w-none">
        <?php the_content(); ?>
    </section>

</article>
