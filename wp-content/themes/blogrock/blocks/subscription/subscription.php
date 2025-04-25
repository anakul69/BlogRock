<?php
$title = get_field('title');
$description = get_field('description');
$button_label = get_field('button_label');
?>

<section class="bg-primary text-white">
    <div class="container text-center py-[45px] px-[30px] 2xl:px-[45px] 2xl:py-[60px]">
        <?php if ($title): ?>
            <h2 class="font-h4 mb-4"><?= esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($description): ?>
            <p class="mb-6 font-body"><?= esc_html($description); ?></p>
        <?php endif; ?>

        <form id="subscription-form" class="flex flex-col md:flex-row items-center justify-center gap-4 max-w-xl mx-auto">
            <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Your e-mail *"
                    required
                    class="px-4 py-2 w-[240px] h-[44px] bg-white/10 text-white placeholder-white border-b border-white"
            />


            <button
                    type="submit"
                    class="bg-secondary w-[171px] h-[44px] hover:bg-secondary-darken text-white font-link-small-heading px-6 py-2 transition"
            >
                <?= esc_html($button_label ?: 'Subscribe'); ?>
            </button>
        </form>

        <div id="form-message" class="mt-4 text-sm font-semibold"></div>
    </div>
</section>
