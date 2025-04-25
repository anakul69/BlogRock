<?php
$title = get_field('title');
$label = get_field('label');
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <?php foreach ($posts as $post): setup_postdata($post); ?>
                <?php
                $author_name = get_field('author_name', $post->ID);
                $author_avatar = get_field('author_avatar', $post->ID);
                ?>
                <a href="<?= get_permalink($post); ?>" class="group flex flex-col lg:flex-row gap-6">
                    <div class="relative size-[285px] lg:size-[250px] shrink-0">
                        <div class="absolute top-[-12px] left-[-12px] w-full size-[285px] lg:size-[235px] bg-secondary z-0"></div>
                        <div class="relative z-10">
                            <?= get_the_post_thumbnail($post, 'medium', ['class' => 'object-cover size-[285px] lg:size-[250px]']); ?>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between mt-4">
                        <?php if ($label): ?>
                            <span class="flex justify-center bg-third text-white w-[72px] h-[26px] px-2 py-1 mb-5 font-small">
                    <?php echo esc_html($label); ?>
                </span>
                        <?php endif; ?>

                        <h3 class="text-lg font-semibold group-hover:text-accent transition leading-snug">
                            <?= get_the_title($post); ?>
                        </h3>

                        <div class="text-sm text-gray-500 mt-2 flex gap-4 items-center flex-wrap">
                            <span class="flex items-center gap-1">
                                Added:
                                <?php
                                $current_locale = get_locale();
                                switch_to_locale('en_US');
                                echo get_the_date('d F Y', $post);
                                switch_to_locale($current_locale);
                                ?>
                            </span>

                            <span class="flex items-center gap-1">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.25 3.125V13.125H3.75V16.3086L4.76562 15.4883L7.71484 13.125H13.75V3.125H1.25ZM2.5 4.375H12.5V11.875H7.28516L7.10938 12.0117L5 13.6914V11.875H2.5V4.375ZM15 5.625V6.875H17.5V14.375H15V16.1914L12.7148 14.375H8.02734L6.46484 15.625H12.2852L16.25 18.8086V15.625H18.75V5.625H15Z" fill="#7B7485"/>
</svg>

                                <?= get_comments_number($post->ID); ?>
                            </span>
                        </div>

                        <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                            <?= get_the_excerpt($post); ?>
                        </p>

                        <?php if ($author_name || $author_avatar): ?>
                            <div class="mt-4 flex items-center gap-2">
                                <?php if ($author_avatar): ?>
                                    <img src="<?= esc_url($author_avatar['url']); ?>" alt="<?= esc_attr($author_name); ?>" class="w-6 h-6 rounded-full" />
                                <?php endif; ?>
                                <?php if ($author_name): ?>
                                    <span class="text-sm text-gray-700"><?= esc_html($author_name); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
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
