<?php

function register_home_fields() {
    if (function_exists('acf_add_local_field_group')) :
        acf_add_local_field_group(array(
            'key' => 'group_home_fields',
            'title' => 'Campos da Home',
            'location' => array(
                array(
                    array(
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ),
                ),
            ),
            'fields' => array(
                array(
                    'key' => 'sobre_tab',
                    'label' => get_lang('About', 'Sobre'),
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ),
                array(
                    'key' => 'sobre-title',
                    // 'label' => 'Título sobre',
                    'label' => get_lang('Title about', 'Título sobre'),
                    'name' => 'sobre-title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'sobre-text',
                    'label' => get_lang('Text about', 'Texto sobre'),
                    'name' => 'sobre-text',
                    'type' => 'textarea',
                    'rows' => 2,
                    'new_lines' => 'wpautop',
                ),
                array(
                    'key' => 'sobre-text-link',
                    'label' => get_lang('Text button', 'Texto do botão'),
                    'name' => 'sobre-text-link',
                    'type' => 'text',
                    'new_lines' => 'wpautop',
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                ),
                array(
                    'key' => 'sobre-link',
                    'label' => get_lang('Page link', 'Link da página'),
                    'name' => 'sobre-link',
                    'type' => 'page_link',
                    'post_type' => 'page',
                    'allow_archives' => false,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                ),
                // array(
                //     'key' => 'local_tab',
                //     'label' => 'Local',
                //     'name' => '',
                //     'type' => 'tab',
                //     'placement' => 'top',
                // ),
                // array(
                //     'key' => 'local-img',
                //     'label' => 'Imagem local',
                //     'name' => 'local-img',
                //     'type' => 'image',
                //     'return_format' => 'url',
                //     'wrapper' => array(
                //         'width' => '50',
                //         'class' => '',
                //         'id' => '',
                //     ),
                // ),
                // array(
                //     'key' => 'local-bg',
                //     'label' => 'Imagem fundo',
                //     'name' => 'local-bg',
                //     'type' => 'image',
                //     'return_format' => 'url',
                //     'wrapper' => array(
                //         'width' => '50',
                //         'class' => '',
                //         'id' => '',
                //     ),
                // ),
                // array(
                //     'key' => 'local-title',
                //     'label' => 'Título local',
                //     'name' => 'local-title',
                //     'type' => 'text',
                // ),
                // array(
                //     'key' => 'local-text',
                //     'label' => 'Texto local',
                //     'name' => 'local-text',
                //     'type' => 'textarea',
                //     'new_lines' => 'wpautop',
                // ),
                // array(
                //     'key' => 'work_tab',
                //     'label' => 'Programação/Trabalhos Científicos',
                //     'name' => '',
                //     'type' => 'tab',
                //     'placement' => 'top',
                // ),
                // array(
                //     'key' => 'prog-work-title',
                //     'label' => 'Título',
                //     'name' => 'prog-work-title',
                //     'type' => 'text',
                // ),
                // array(
                //     'key' => 'prog-work-text',
                //     'label' => 'Texto',
                //     'name' => 'prog-work-text',
                //     'type' => 'textarea',
                // ),
                // array(
                //     'key' => 'palestrantes_tab',
                //     'label' => 'Palestrantes',
                //     'name' => '',
                //     'type' => 'tab',
                //     'placement' => 'top',
                // ),
                // array(
                //     'key' => 'palestrantes',
                //     'label' => 'Palestrantes',
                //     'name' => 'palestrantes',
                //     'type' => 'repeater',
                //     'sub_fields' => array(
                //         array(
                //             'key' => 'palestrante_foto',
                //             'label' => 'Foto',
                //             'name' => 'palestrante_foto',
                //             'type' => 'image',
                //             'return_format' => 'url',
                //         ),
                //         array(
                //             'key' => 'palestrante_nome',
                //             'label' => 'Nome',
                //             'name' => 'palestrante_nome',
                //             'type' => 'text',
                //         ),
                //         array(
                //             'key' => 'palestrante_cidade',
                //             'label' => 'Cidade/Estado',
                //             'name' => 'palestrante_cidade',
                //             'type' => 'text',
                //         ),

                //     )
                // ),
                // array(
                //     'key' => 'parceiros_tab',
                //     'label' => 'Parceiros',
                //     'name' => '',
                //     'type' => 'tab',
                //     'placement' => 'top',
                // ),
                // array(
                //     'key' => 'diamante',
                //     'label' => 'Diamante',
                //     'name' => 'diamante',
                //     'type' => 'repeater',
                //     'sub_fields' => array(
                //         array(
                //             'key' => 'logo_diamante',
                //             'label' => 'Logo',
                //             'name' => 'logo_diamante',
                //             'type' => 'image',
                //             'return_format' => 'url',
                //         ),
                //     )
                // ),
                // array(
                //     'key' => 'ouro',
                //     'label' => 'Ouro',
                //     'name' => 'ouro',
                //     'type' => 'repeater',
                //     'sub_fields' => array(
                //         array(
                //             'key' => 'logo_ouro',
                //             'label' => 'Logo',
                //             'name' => 'logo_ouro',
                //             'type' => 'image',
                //             'return_format' => 'url',
                //         ),
                //     )
                // ),
                // array(
                //     'key' => 'prata',
                //     'label' => 'Prata',
                //     'name' => 'prata',
                //     'type' => 'repeater',
                //     'sub_fields' => array(
                //         array(
                //             'key' => 'logo_prata',
                //             'label' => 'Logo',
                //             'name' => 'logo_prata',
                //             'type' => 'image',
                //             'return_format' => 'url',
                //         ),
                //     )
                // ),
                // array(
                //     'key' => 'vip',
                //     'label' => 'Vip',
                //     'name' => 'vip',
                //     'type' => 'repeater',
                //     'sub_fields' => array(
                //         array(
                //             'key' => 'logo_vip',
                //             'label' => 'Logo',
                //             'name' => 'logo_vip',
                //             'type' => 'image',
                //             'return_format' => 'url',
                //         ),
                //     )
                // )
            )
        ));
    endif;
}

add_action('acf/init', 'register_home_fields');
