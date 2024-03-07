<!doctype html>
<html>

<head>
    <title>
        <?php the_title(); ?>
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="theme-color" content="#48242e" />
    <?php wp_head(); ?>
    <script>
        var wpurl = '<?php bloginfo('template_url'); ?>';
        var path = '<?php echo preg_replace('/\/pt-br/', '', get_bloginfo('url')) ?>';
    </script>
    <link rel="stylesheet" href="<?php path('css/reset.css') ?>">
    <link rel="stylesheet" href="<?php path('css/common.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" media="print" onload="this.media='all'" />
</head>

<body <?php body_class(); ?> style="opacity: 0;">
    <?php wp_body_open(); ?>
    <header>
        <div class="logo">
            <img onclick="window.location.href = '<?php echo home_url(); ?>'" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="YouLosty - Logo">
        </div>
        <div class="language">
            <div class="switch-language">
                <?php if (function_exists('wpm_language_switcher')) wpm_language_switcher(); ?>
            </div>
            <div class="item-language-pt-br">
                <img src="<?php echo get_template_directory_uri(); ?>/img/br.svg" alt="Brazil Flag">
            </div>
            <div class="item-language-en">
                <img src="<?php echo get_template_directory_uri(); ?>/img/us.svg" alt="United States Flag">
            </div>
        </div>
        <div class="menu">
            <div class="kebab"></div>
            <nav>
                <ul>
                    <li class="hidden"><?php lang('Choose your language', 'Selecionar idioma') ?>
                        <div class="language">
                            <div class="switch-language">
                                <?php if (function_exists('wpm_language_switcher')) wpm_language_switcher(); ?>
                            </div>
                            <div class="item-language-pt-br">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/br.svg" alt="Brazil Flag">
                            </div>
                            <div class="item-language-en">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/us.svg" alt="United States Flag">
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php echo get_permalink(get_page_by_path('about-us')); ?>"><?php lang('About us', 'Sobre') ?></a></li>
                    <li class="hidden"><a href=""><?php lang('Search for losted items', 'Procurar itens perdidos') ?></a></li>
                    <li class="hidden"><a href=""><?php lang('Search for founded items', 'Procurar itens achados') ?></a></li>
                    <li class="hidden"><a href=""><?php lang('Suggestions', 'Sugestões') ?></a></li>
                    <li onclick="terms()"><a href="#"><?php lang('Terms and conditions', 'Termos e condições') ?></a></li>
                </ul>
            </nav>
        </div>
    </header>