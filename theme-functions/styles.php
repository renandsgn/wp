<?php

function loadstyles() {
    $home = array('home');
    if (in_array(get_post_field('post_name', get_post()), $home)) {
        wp_enqueue_style('home', get_template_directory_uri() . '/css/home.css');
    }
    $forgot = array('forgot-password');
    if (in_array(get_post_field('post_name', get_post()), $forgot)) {
        wp_enqueue_style('forgot-password', get_template_directory_uri() . '/css/forgot.css');
    }
    $panel = array('panel');
    if (in_array(get_post_field('post_name', get_post()), $panel)) {
        wp_enqueue_style('panel', get_template_directory_uri() . '/css/panel.css');
    }
}
add_action('wp_enqueue_scripts', 'loadstyles');
