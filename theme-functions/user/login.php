<?php


// Função para processar o login
function custom_login_process() {
    // Verifica se os campos de nome de usuário e senha foram enviados
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = sanitize_user($_POST['username']);
        $password = sanitize_text_field($_POST['password']);

        $login_data = array(
            'user_login' => sanitize_user($_POST['username']),
            'user_password' => $_POST['password'],
            'remember' => true,
        );

        // Tenta fazer login
        $user = wp_signon($login_data, true);

        if (is_wp_error($user)) {
            $response;
            if ($_POST['lang'] != 'en') {
                $response = 'Login falhou. Por favor, verifique suas credenciais.';
            } else {
                $response = 'Login failed. Please check your credentials.';
            }
            // Se houver um erro no login, retorna uma resposta JSON com uma mensagem de erro
            wp_send_json_error(array('message' => esc_html__($response, 'text-domain')));
        } else {
            // Se o login for bem-sucedido, retorna uma resposta JSON com a URL de redirecionamento

            wp_clear_auth_cookie();
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);

            wp_send_json_success(array('redirect_url' => home_url('/panel')));
        }
    }
}

// Adiciona a ação para processar o login para usuários logados e não autenticados
add_action('wp_ajax_custom_login', 'custom_login_process');
add_action('wp_ajax_nopriv_custom_login', 'custom_login_process');
