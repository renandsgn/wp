<?php

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    
    add_image_size( '500x450', 500, 450, array('center', 'center'));
}

function thumbs_names( $sizes ) {
    return array_merge( $sizes, 
        array(
            '500x450' => __( 'Mobile' ),
        ) 
    );
}
add_filter( 'image_size_names_choose','thumbs_names' );





