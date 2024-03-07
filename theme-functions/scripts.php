<?php

// wp_enqueue_script('dcsnt', '/js/jquery.social.media.tabs.1.7.1.min.js#asyncload' )

// switch (true) {
//     case is_page('home'):
//         wp_enqueue_script('dcsnt', 'https://unpkg.com/micromodal/dist/micromodal.min.js#asyncload' );
//     break;
// }

function loadscripts() {
    $modal = array('home');
    if(in_array(get_post_field( 'post_name', get_post() ), $modal)) {
        wp_enqueue_script('dcsnt', 'https://unpkg.com/micromodal/dist/micromodal.min.js#asyncload', '', '', true );
    }
}
add_action('wp_enqueue_scripts', 'loadscripts');