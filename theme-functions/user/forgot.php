<?php

add_action('wp_ajax_forgot_password', 'forgot_password');
add_action('wp_ajax_nopriv_forgot_password', 'forgot_password');
function forgot_password() {
    $email = sanitize_email($_POST['email']);

    // Verifica se o email já está em uso
    if (!email_exists($email)) {
        echo 'erro';
        wp_die();
    }

    $usuario = get_user_by('email', $email);
    $reset = wp_generate_password(6, false);


    update_field('recovery-hash', $reset, 'user_' . $usuario->ID);


    echo 'sucesso';

    wp_die();
}




add_action('wp_ajax_forgot_password_mail', 'forgot_password_mail');
add_action('wp_ajax_nopriv_forgot_password_mail', 'forgot_password_mail');
function forgot_password_mail() {

    $email = sanitize_email($_POST['email']);

    $user = get_user_by('email', $_POST['email']);

    $assunto = custom_lang('Reset your password', 'Redefina sua senha');

    $hash = get_field('recovery-hash', 'user_' . $user->ID);
    ob_start();
    include('mail-forgot.php');
    $mensagem = ob_get_clean();
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . get_field('from_name', 'option') . '<' . get_field('from', 'option') . '>');
    wp_mail($email, $assunto, $mensagem, $headers);

    echo 'enviado';

    wp_die();
}




add_action('wp_ajax_verify_reset_code', 'verify_reset_code');
add_action('wp_ajax_nopriv_verify_reset_code', 'verify_reset_code');
function verify_reset_code() {

    $email = sanitize_email($_POST['email']);

    $user = get_user_by('email', $_POST['email']);

    $hash = get_field('recovery-hash', 'user_' . $user->ID);

    if ($_POST['code'] == $hash) {
        echo 'sucesso';
    } else {
        echo 'erro';
    }

    wp_die();
}


add_action('wp_ajax_change_password', 'change_password');
add_action('wp_ajax_nopriv_change_password', 'change_password');
function change_password() {

    $email = sanitize_email($_POST['email']);
    $user = get_user_by('email', $_POST['email']);

    if (!is_wp_error(wp_set_password($_POST['password'], $user->ID))) {
        update_field('recovery-hash', '', 'user_' . $user->ID);
        echo 'sucesso';
    } else {
        echo 'erro';
    }

    wp_die();
}
