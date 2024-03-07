<?php

add_action('wp_ajax_registrar_usuario', 'registrar_usuario');
add_action('wp_ajax_nopriv_registrar_usuario', 'registrar_usuario');
function registrar_usuario() {
    $email = sanitize_email($_POST['email']);
    $senha = sanitize_text_field($_POST['senha']);

    // Verifica se o email já está em uso
    if (email_exists($email)) {
        echo 'erro';
        wp_die();
    }

    // Cria o usuário
    $usuario_id = wp_create_user($email, $senha, $email);

    // Verifica se houve erro ao criar o usuário
    if (is_wp_error($usuario_id)) {
        echo 'erro';
        wp_die();
    }

    // $salt = wp_generate_password(20, false);
    // $hash = wp_generate_password(32, false);
    // $hash_ativacao = md5($email . $salt . $hash);
    // $url  = get_bloginfo('siteurl') . '/' . custom_lang('en', 'pt-br') .  '/activate?u=' . $usuario_id . '&h=' . $hash_ativacao;

    // update_user_meta($usuario_id, 'activation-hash', $hash_ativacao);


    // $assunto = custom_lang('Activate your account', 'Ativar sua conta');
    // ob_start();
    // include('mail.php');
    // $mensagem = ob_get_clean();
    // $headers = array('Content-Type: text/html; charset=UTF-8', 'From: X CBEV<congresso@cbev2023.com.br>');
    // wp_mail($email, $assunto, $mensagem, $headers);

    echo 'sucesso';

    wp_die();
}


function auto_login() {
    // @TODO: change these 2 items
    $loginpageid   = get_page_by_path('activate')->ID; //Page ID of your login page

    if (isset($_GET['u'])) {
        $loginusername = get_user_by('id',  $_GET['u'])->user_login;
    }

    if (isset($_GET['h'])) {
        $user = get_user_by('login',  $loginusername);
        $hash = get_field('activation-hash', 'user_' . $user->ID);
        $redirect;

        if ($hash != $_GET['h']) {
            $redirect = '/activate?error1';
        } else {
            $redirect = '/panel';
        }

        if (
            !is_page($loginpageid)
            || !$user instanceof WP_User
        ) {
            return;
        }

        $user_id = $user->ID;

        if ($hash == $_GET['h']) {
            // login as this user
            wp_set_current_user($user_id, $loginusername);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $loginusername, $user);
            update_field('activation-hash', 'confirmed', 'user_' . $user->ID);
        }

        wp_redirect(home_url() . '/' . wpm_get_language() . $redirect);
        exit;
    }
}

add_action('wp', 'auto_login', 1);



add_action('wp_ajax_send_activation_mail', 'send_activation_mail');
add_action('wp_ajax_nopriv_send_activation_mail', 'send_activation_mail');
function send_activation_mail() {
    $email = sanitize_email($_POST['email']);
    $senha = sanitize_text_field($_POST['senha']);

    $usuario_id = get_user_by('email', $email)->ID;


    $salt = wp_generate_password(20, false);
    $hash = wp_generate_password(32, false);
    $hash_ativacao = md5($email . $salt . $hash);
    $url  = get_bloginfo('siteurl') . '/' . custom_lang('en', 'pt-br') .  '/activate?u=' . $usuario_id . '&h=' . $hash_ativacao;

    update_user_meta($usuario_id, 'activation-hash', $hash_ativacao);


    $assunto = custom_lang('Activate your account', 'Ativar sua conta');
    ob_start();
    include('mail.php');
    $mensagem = ob_get_clean();
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . get_field('from_name', 'option') . '<' . get_field('from', 'option') . '>');
    wp_mail($email, $assunto, $mensagem, $headers);

    echo "email enviado";

    wp_die();
}
