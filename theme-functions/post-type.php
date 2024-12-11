<?php

function exemplo_ctp() {
    register_post_type('exemplo', array(
      'label' => 'Exemplo',
      'description' => 'Exemplo',
      'public' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'rewrite' => array('slug' => 'exemplo', 'with_front' => true),
      'query_var' => true,
      'menu_position' => 4,
      'show_in_rest' => true,
      'supports' => array('editor','thumbnail', 'excerpt','custom-fields','title'),
      'publicly_queryable' => true
    ));
}
add_action('init', 'exemplo_ctp');