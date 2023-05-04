<?php

function loadstyles() {
    $tiny = array('home');
    if(in_array(get_post_field( 'post_name', get_post() ), $tiny)) {
        wp_enqueue_style( 'tiny', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css' );
    }
}
add_action('wp_enqueue_scripts', 'loadstyles');