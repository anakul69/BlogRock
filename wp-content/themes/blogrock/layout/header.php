<?php
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="bg-white relative z-50">
    <div class="container mx-auto flex items-center justify-between px-5 lg:py-6">
        <?php if ( $logo = get_field( 'site_logo', 'option' ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="shrink-0">
                <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>" class="h-10 w-auto">
            </a>
        <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-heading font-bold text-xl">
                <?php bloginfo( 'name' ); ?>
            </a>
        <?php endif; ?>

        <div class="hidden lg:flex items-center gap-8">
            <nav class="relative">
                <?php
                wp_nav_menu([
                    'theme_location' => 'main_menu',
                    'container' => false,
                    'menu_class' => 'flex gap-8 font-body text-text',
                    'depth' => 2,
                    'fallback_cb' => false,
                    'walker' => new class extends Walker_Nav_Menu {
                        public function start_lvl( &$output, $depth = 0, $args = null ) {
                            $output .= '<ul class="absolute left-0 top-[45px] hidden group-hover:block bg-gray-lighten shadow-lg min-w-[200px] z-50">';
                        }

                        public function end_lvl( &$output, $depth = 0, $args = null ) {
                            $output .= '</ul></div>';
                        }

                        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
                            $has_child = in_array( 'menu-item-has-children', (array) $item->classes, true );
                            $output .= '<li class="' . ( $has_child ? 'relative group' : '' ) . '">';

                            if ( $depth === 0 ) {
                                $output .= '<div class="inline-block">';
                                $output .= '<a href="' . esc_url( $item->url ) . '" class="inline-flex items-center gap-1 mb-4 px-3 py-2 h-[20px] leading-none font-menu border-b-2 border-transparent hover:border-secondary transition-all">';
                                $output .= esc_html( $item->title );

                                if ( $has_child ) {
                                    $output .= '<span class="w-[12px] h-[12px] transition-transform duration-200 transform group-hover:rotate-180 origin-center inline-block">
                                        <svg class="w-full h-full text-current" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>';
                                }

                                $output .= '</a>';
                            } else {
                                $output .= '<a href="' . esc_url( $item->url ) . '" class="block px-4 py-3 font-body text-sm transition">
                                    <span class="border-b-2 border-transparent hover:border-secondary inline-block">' . esc_html( $item->title ) . '</span>
                                </a>';
                            }
                        }

                        public function end_el( &$output, $item, $depth = 0, $args = null ) {
                            $output .= '</li>';
                        }
                    }
                ]);
                ?>
            </nav>

            <div class="relative">
                <button id="searchToggle" class="w-[63px] h-[77px] flex items-center justify-center transition-colors" aria-label="Search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="M21 21 16.65 16.65"/>
                    </svg>
                </button>

                <form id="searchForm" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="absolute right-0 top-full mt-3 hidden opacity-0 pointer-events-none transition-all duration-200">
                    <div class="flex items-center w-[300px] border-b border-text bg-gray-lighten">
                        <input id="searchInput" name="s" type="search" placeholder="<?php esc_attr_e('Search', 'blogrock'); ?>" class="flex-grow bg-gray-lighten px-3 py-2 text-sm focus:outline-none">
                        <button class="px-3" aria-label="Submit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="M21 21 16.65 16.65"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex lg:hidden">
            <button id="mSearchToggle" aria-label="Search" class="w-[63px] h-[77px] flex items-center justify-center transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="M21 21 16.65 16.65"/>
                </svg>
            </button>
            <button id="mMenuToggle" aria-label="Menu" class="w-[63px] h-[77px] flex items-center justify-center transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>

    <section id="mobileSearch" class="fixed top-0 left-0 right-0 z-50 bg-gray-lighten transition-transform duration-300 hidden lg:hidden">
        <form role="search" method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="p-6 flex justify-center">
            <div class="flex items-center w-[300px] border-b border-text">
                <input id="drawerSearch" name="s" type="search" placeholder="<?php esc_attr_e('Search','blogrock'); ?>" class="flex-grow bg-gray-lighten px-3 py-2 text-sm focus:outline-none">
                <button class="px-3" aria-label="Submit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="M21 21 16.65 16.65"/>
                    </svg>
                </button>
            </div>
        </form>
    </section>

    <nav id="mobileMenu" class="fixed top-0 left-0 right-0 z-50 max-h-[390px] overflow-y-auto bg-gray-lighten transition-transform duration-300 hidden lg:hidden">
        <?php
        wp_nav_menu([
            'theme_location' => 'main_menu',
            'container' => false,
            'menu_class' => 'px-10 pb-[72px] pt-3 space-y-5 font-body-large text-black',
            'depth' => 1,
            'fallback_cb' => false,
        ]);
        ?>
    </nav>
</header>