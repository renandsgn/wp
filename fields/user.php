<?php

function register_user_fields() {
    if (function_exists('acf_add_local_field_group')) :
        acf_add_local_field_group(
            array(
                'key' => 'group_user_fields',
                'title' => 'Campos Usuário',
                'location' => array(
                    array(
                        array(
                            'param' => 'user_role',
                            'operator' => '==',
                            'value' => 'subscriber',
                        ),
                    ),
                ),
                'fields' => array(
                    array(
                        'key' => 'activation-hash',
                        'label' => get_lang('Hash', 'Hash'),
                        'name' => 'activation-hash',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'recovery-hash',
                        'label' => get_lang('Recovery Hash', 'Recovery Hash'),
                        'name' => 'recovery-hash',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'profile-completed',
                        'label' => get_lang('Profile complete', 'Perfil completo'),
                        'name' => 'profile-completed',
                        'type' => 'radio',
                        'default_value' => 'no',
                        'choices' => array(
                            'yes' => get_lang('Yes', 'Sim'),
                            'no' => get_lang('No', 'Não'),
                        ),
                    ),
                    array(
                        'key' => 'first-name',
                        'label' => get_lang('First Name', 'Primeiro Nome'),
                        'name' => 'first-name',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => 50,
                        )
                    ),
                    array(
                        'key' => 'last-name',
                        'label' => get_lang('Last Name', 'Sobrenome'),
                        'name' => 'last-name',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => 50,
                        )
                    ),
                    array(
                        'key' => 'organization',
                        'label' => get_lang('Organization', 'Organização'),
                        'name' => 'organization',
                        'type' => 'radio',
                        'choices' => array(
                            'no' => get_lang('No', 'Não'),
                            'yes' => get_lang('Yes', 'Sim'),
                        )
                    ),
                    array(
                        'key' => 'app-driver',
                        'label' => get_lang('App driver', 'Motorista de aplicativo'),
                        'name' => 'app-driver',
                        'type' => 'radio',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'organization',
                                    'operator' => '==',
                                    'value' => 'no',
                                ),
                            ),
                        ),
                        'choices' => array(
                            'no' => get_lang('No', 'Não'),
                            'yes' => get_lang('Yes', 'Sim'),
                        )
                    ),
                    array(
                        'key' => 'profile-picture',
                        'label' => get_lang('Profile Picture', 'Imagem de perfil'),
                        'name' => 'profile-picture',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'instructions' => get_lang('Upload your profile picture', 'Envie sua imagem de perfil'),
                    ),
                    array(
                        'key' => 'phone-number',
                        'label' => get_lang('Phone Number', 'Número de telefone'),
                        'name' => 'phone-number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'facebook',
                        'label' => get_lang('Facebook', 'Facebook'),
                        'name' => 'facebook',
                        'type' => 'url',
                    )
                ),

            )
        );
    endif;
}

add_action('acf/init', 'register_user_fields');
