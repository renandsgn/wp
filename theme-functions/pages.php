<?php

$title = wpm_ml_array_to_string(array('en' => 'Password recovery', 'pt-br' => 'Recuperar senha'));
$forgot = array(
    'post_title'    => $title,
    'post_content'  => '',
    'post_status'   => 'publish',
    'post_author'   => 1,
    'post_type' => 'page',
    'post_name' => 'forgot-password',
);
if (!get_page_by_path('forgot-password')) {
    wp_insert_post($forgot);
}
