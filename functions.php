<?php

include_once 'theme-functions/default.php';
include_once 'theme-functions/post-type.php';
include_once 'theme-functions/thumbs.php';
include_once 'theme-functions/scripts.php';
include_once 'theme-functions/styles.php';

function new_menu() {
    register_nav_menu('menu-nome', __( 'Menu' ));
}
add_action( 'init', 'new_menu' );

function sprite($arg, $print) {
    if($print == true) {
        echo '<use xlink:href="'.get_bloginfo( 'template_url' ).'/svg/sprite.svg#'.$arg.'"></use>';
    } else {
        return '<use xlink:href="'.get_bloginfo( 'template_url' ).'/svg/sprite.svg#'.$arg.'"></use>';
    }
}

function my_deregister_javascript() {
    wp_deregister_script( 'jquery' );    
}
add_action( 'wp_enqueue_scripts', 'my_deregister_javascript' );

function my_custom_page_word() {
    global $wp_rewrite;  
    $wp_rewrite->pagination_base = "pagina"; 
}
add_action( 'init', 'my_custom_page_word' );


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
    echo get_bloginfo( 'template_url' ) . '/' . $path;
}

