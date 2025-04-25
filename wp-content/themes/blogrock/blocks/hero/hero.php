<?php
$label = get_field('label');
$title = get_field('title');
$description = get_field('description');
$image = get_field('image');
?>

<section class="pt-[50px] pb-[87px] bg-white">
    <div class="container mx-auto flex flex-col-reverse lg:flex-row lg:items-center justify-around gap-10">
        <div class="max-w-[558px]">
            <?php if ($label) : ?>
                <span class="inline-block bg-third text-white px-3 py-1 mb-5 font-body">
                    <?php echo esc_html($label); ?>
                </span>
            <?php endif; ?>

            <?php if ($title) : ?>
                <h2 class="font-link-medium-heading lg:font-h2 text-text mb-5">
                    <?php echo esc_html($title); ?>
                </h2>
            <?php endif; ?>

            <?php if ($description) : ?>
                <p class="text-text leading-relaxed font-body">
                    <?php echo esc_html($description); ?>
                </p>
            <?php endif; ?>
        </div>

        <?php if (!empty($image)) : ?>
        <div class="flex justify-center">
            <div class="relative">
                <div class="absolute -top-5 -left-5 lg:-top-6 lg:-left-10 2xl:-top-10 2xl:-left-20 w-full size-[285px] md:size-full xl:w-full xl:h-[433px] bg-secondary z-0"></div>

                <img src="<?php echo esc_url($image['url']); ?>"
                     alt="<?php echo esc_attr($image['alt']); ?>"
                     class="relative z-10 shadow-xl size-[285px] md:size-full lg:w-full lg:h-auto object-cover" />
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
