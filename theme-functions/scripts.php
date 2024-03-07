<?php

// wp_enqueue_script('dcsnt', '/js/jquery.social.media.tabs.1.7.1.min.js#asyncload' )

// switch (true) {
//     case is_page('home'):
//         wp_enqueue_script('dcsnt', 'https://unpkg.com/micromodal/dist/micromodal.min.js#asyncload' );
//     break;
// }

function loadscripts() {
    $home = array('home');
    if (in_array(get_post_field('post_name', get_post()), $home)) {
        wp_enqueue_script('home', get_template_directory_uri() . '/dist/js/home.js#asyncload', '', '', true);
    }

    $forgot = array('forgot-password', 'password-recovery');
    if (in_array(get_post_field('post_name', get_post()), $forgot)) {
        wp_enqueue_script('forgot', get_template_directory_uri() . '/dist/js/forgot.js#asyncload', '', '', true);
    }
    wp_enqueue_script('global', get_template_directory_uri() . '/dist/js/common.js#asyncload', '', '', true);
}
add_action('wp_enqueue_scripts', 'loadscripts');
