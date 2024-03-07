<?php

include_once 'theme-functions/default.php';
include_once 'theme-functions/post-type.php';
include_once 'theme-functions/thumbs.php';
include_once 'theme-functions/scripts.php';
include_once 'theme-functions/styles.php';
include_once 'theme-functions/pages.php';

include_once 'theme-functions/user/register.php';
include_once 'theme-functions/user/login.php';
include_once 'theme-functions/user/forgot.php';


foreach (glob(get_stylesheet_directory() . '/fields/*.php') as $filename) {
    include_once $filename;
}

function new_menu() {
    register_nav_menu('menu-nome', __('Menu'));
}
add_action('init', 'new_menu');

function sprite($arg, $print) {
    if ($print == true) {
        echo '<use xlink:href="' . get_bloginfo('template_url') . '/svg/sprite.svg#' . $arg . '"></use>';
    } else {
        return '<use xlink:href="' . get_bloginfo('template_url') . '/svg/sprite.svg#' . $arg . '"></use>';
    }
}

function my_deregister_javascript() {
    wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts', 'my_deregister_javascript');

function my_custom_page_word() {
    global $wp_rewrite;
    $wp_rewrite->pagination_base = "pagina";
}
add_action('init', 'my_custom_page_word');


function placeholder($w, $h, $fill = null) {
    $fill = isset($fill) ? $fill : 'transparent';
    $svg = '';

    $svg .= "<svg viewBox='0 0 {$w} {$h}' width='{$w}' height='{$h}' fill='{$fill}' preserveAspectRatio='xMinYMin meet' xmlns='http://www.w3.org/2000/svg'>";
    $svg .= "<path d='M0 0h171v232H0z' y='0' x='0' />";
    $svg .= "</svg>";

    // $encodedSVG = \rawurlencode(\str_replace(["\r", "\n"], ' ', $svg));
    $svg = preg_replace('/(\r|\n)/m', ' ', $svg);

    return "data:image/svg+xml;utf8,{$svg}";
    // return $svg;
}

function path($path) {
    echo get_bloginfo('template_url') . '/' . $path;
}


// SMTP
add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = get_field('host', 'option');
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = get_field('port', 'option');
    $phpmailer->Username   = get_field('username', 'option');
    $phpmailer->Password   = get_field('password', 'option');
    // $mail->SMTPAutoTLS = true;
    // $mail->SMTPSecure = 'ssl';
    $phpmailer->From       = get_field('from', 'option');
    $phpmailer->FromName   = get_field('from_name', 'option');
}


function close($stroke) {
    echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 11 11"><path stroke="#' . $stroke . '" stroke-width="1.1" d="m1.3 1.3 8.4 8.4M9.7 1.3 1.3 9.7"/></svg>';
}


add_filter('body_class', 'custom_class');
function custom_class($classes) {
    global $post;
    $classes[] = 'template-' . sanitize_title($post->post_title);
    return $classes;
}



function custom_lang($str, $str2) {
    $msg;
    if ($_COOKIE['language'] == 'en') {
        $msg = $str;
    } else {
        $msg = $str2;
    }
    return $msg;
}


function redirect_to_home_login() {
    if (preg_match('/(wp-login.php|wp-admin|panel)/', $_SERVER['REQUEST_URI'], $matches) !== false && !(defined('DOING_AJAX') && DOING_AJAX)) {
        if (isset(wp_get_current_user()->roles[0]) && wp_get_current_user()->roles[0] != 'administrator' || !is_user_logged_in()) {
            wp_redirect(home_url());
        }
        if (isset($matches[0])) {
            if (wp_get_current_user()->roles[0] == 'administrator' && is_user_logged_in() && $matches[0] == 'wp-login.php') {
                wp_redirect(home_url() . '/wp-admin');
            }
            if (wp_get_current_user()->roles[0] == 'administrator' && is_user_logged_in() && $matches[0] == 'panel') {
                echo '<script>window.location.href = "' . home_url() . '/wp-admin";</script>';
            }
        }
    }
}
// Adiciona a função acima aos hooks de verificação de acesso ao wp-login.php
add_action('init', 'redirect_to_home_login');




function enqueue_admin_custom_css() {
    wp_enqueue_style('admin-custom', get_template_directory_uri() . '/css/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'enqueue_admin_custom_css');
