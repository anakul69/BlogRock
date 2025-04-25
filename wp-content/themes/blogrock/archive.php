<?php get_template_part('layout/header'); ?>

<main class="container mx-auto px-4 py-12">
    <header class="mb-12 text-center">
        <h1 class="text-4xl font-bold mb-2">
            <?= post_type_archive_title('', false) ?: 'Articles'; ?>
        </h1>
    </header>

    <?php
    $paged = get_query_var('paged') ?: 1;

    $query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $paged,
    ]);
    ?>

    <?php if ($query->have_posts()) : ?>
        <section class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <article class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="aspect-w-4 aspect-h-3">
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                            </div>
                        </a>
                    <?php endif; ?>

                    <div class="p-5">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="<?php the_permalink(); ?>" class="hover:text-accent transition">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <p class="text-sm text-gray-600 mb-4"><?php the_excerpt(); ?></p>
                        <div class="text-xs text-gray-400">
                            <?php the_time('F j, Y'); ?> · <?php the_author(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </section>

        <div class="mt-12 text-center">
            <?php
            echo paginate_links([
                'total' => $query->max_num_pages,
                'current' => $paged,
                'mid_size' => 2,
                'prev_text' => __('« Previous', 'blogrock'),
                'next_text' => __('Next »', 'blogrock'),
            ]);
            ?>
        </div>
    <?php else : ?>
        <p class="text-center text-gray-600">No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
