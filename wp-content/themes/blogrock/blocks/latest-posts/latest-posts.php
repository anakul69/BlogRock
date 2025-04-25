<?php
$title = get_field('title');
$posts = get_posts([
    'post_type' => 'post',
    'posts_per_page' => 4,
    'suppress_filters' => false,
]);
?>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <?php if ($title): ?>
            <h2 class="text-4xl font-semibold text-center mb-12"><?= esc_html($title); ?></h2>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <?php foreach ($posts as $post): setup_postdata($post); ?>
                <a href="<?= get_permalink($post); ?>" class="group flex flex-col sm:flex-row gap-6">
                    <div class="relative w-full sm:w-[180px] shrink-0">
                        <div class="absolute top-[-12px] left-[-12px] w-full h-[100px] bg-secondary z-0"></div>
                        <div class="relative z-10">
                            <?= get_the_post_thumbnail($post, 'medium', ['class' => 'w-full']); ?>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between">
                        <?php
                        $categories = get_the_category($post->ID);
                        $category_name = $categories ? $categories[0]->name : '';
                        ?>
                        <?php if ($category_name): ?>
                            <span class="inline-block text-xs bg-fuchsia-600 text-white px-2 py-0.5 rounded mb-2">
                                <?= esc_html($category_name); ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="text-lg font-semibold group-hover:text-accent transition leading-snug">
                            <?= get_the_title($post); ?>
                        </h3>

                        <div class="text-sm text-gray-500 mt-2 flex gap-4 items-center flex-wrap">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 6.75h7.5m-7.5 4.5h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <?= get_the_date('d F Y', $post); ?>
                            </span>

                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17.25 6.75v10.5M12 6.75v10.5M6.75 6.75v10.5"/>
                                </svg>
                                <?= get_comments_number($post->ID); ?>
                            </span>
                        </div>

                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                            <?= get_the_excerpt($post); ?>
                        </p>

                        <div class="mt-4 flex items-center gap-2">
                            <?= get_avatar(get_the_author_meta('ID'), 24, '', '', ['class' => 'rounded-full w-6 h-6']); ?>
                            <span class="text-sm text-gray-700">
                                <?= get_the_author_meta('display_name'); ?>
                            </span>
                        </div>
                    </div>
                </a>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>

        <div class="text-center mt-12">
            <a href="<?= esc_url(get_post_type_archive_link('post')); ?>"
               class="inline-block bg-secondary text-white px-6 py-3 rounded hover:bg-accent-dark transition">
                View All Posts
            </a>
        </div>
    </div>
</section>
