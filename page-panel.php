<?php get_header(); ?>
<main>
    <?php if (is_user_logged_in()) : ?>
        <?php $user = wp_get_current_user(); ?>
        <div class="wrapper">
            <div class="container">
                <div class="left"></div>
                <div class="right">
                    <div>
                        <?php if (get_field('profile-completed', 'user_' . $user->ID) == 'no') : ?>
                            <h1 class="primary-title"><?php lang('Complete your profile', 'Conclua seu perfil') ?></h1>
                            <div class="wrapper-form">
                                <div class="half">
                                    <input type="text" data-type="name" name="first-name" id="first-name">
                                    <label for="first-name"><?php lang('First Name', 'Primeiro Nome'); ?></label>
                                </div>
                                <div class="half">
                                    <input type="text" data-type="name" name="last-name" id="last-name">
                                    <label for="last-name"><?php lang('Last Name', 'Sobrenome'); ?></label>
                                </div>
                                <div class="group">
                                    <p><?php lang('You are an person or organization?', 'Voce é pessoa ou organização?') ?></p>
                                    <div>
                                        <input type="radio" name="person-organization" id="person" value="person">
                                        <label for="person"><?php lang('Person', 'Pessoa'); ?></label>
                                    </div>
                                    <div>
                                        <input type="radio" name="person-organization" id="organization" value="organization">
                                        <label for="organization"><?php lang('Organization', 'Organização'); ?></label>
                                    </div>
                                    <div>
                                        <input type="radio" name="person-organization" id="app-driver" value="app-driver">
                                        <label for="app-driver"><?php lang('App driver', 'Motorista de aplicativo'); ?></label>
                                    </div>
                                </div>
                                <?php if (get_field('profile-picture', 'user_' . $user->ID) == '') : ?>
                                    <div class="half conditional-person">
                                        <input accept="image/jpeg,image/jpg,image/png" style="display: none;" type="file" name="profile-picture" id="profile-picture">
                                        <label for="profile-picture">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                                    <path fill="#616161" d="M9.3 2.6v12.6c0 .5.3.8.7.8.4 0 .7-.3.7-.8V2.6l2.1 2.2c.1.2.3.2.5.2s.4 0 .5-.2c.3-.3.3-.8 0-1L10.5.1a.7.7 0 0 0-1 0L6.2 3.7c-.3.3-.3.8 0 1.1.3.3.7.3 1 0l2-2.2ZM2 8.7c.2-.2.8-.2 1.5-.2h.7c.5 0 .8-.3.8-.8 0-.4-.4-.7-.8-.7h-.7c-1 0-2 0-2.7.6-.5.5-.8 1.2-.8 2.2v8.4c0 1 .2 1.7.7 2.2.7.6 1.5.6 2.6.6H4c.5 0 .8-.3.8-.7 0-.5-.3-.8-.8-.8h-.4c-.8 0-1.5 0-1.7-.2-.1 0-.3-.3-.3-1.1V9.8c0-.6.1-1 .3-1.1Z" />
                                                    <path fill="#616161" d="M20.2 7.8c-1-.9-2.3-.8-3.4-.8h-.4c-.5 0-.9.4-.9.8s.4.7.9.7h.5c.8 0 1.7 0 2.2.3.2.2.3.5.3 1V18l-.4.6c-.4.5-.9.7-1.6.8H6.8c-.4 0-.8.3-.8.8 0 .4.4.7.8.7h10.7a4 4 0 0 0 2.9-1.4 3.1 3.1 0 0 0 .6-1.4V9.8c0-.9-.3-1.6-.8-2Z" />
                                                </svg>
                                                <?php lang('Upload your avatar', 'Enviar sua foto de perfil') ?>
                                            </span>
                                        </label>
                                    </div>
                                <?php endif; ?>
                                <div class="half">
                                    <select name="state" id="state">
                                        <option selected disabled value="<?php lang('State', 'Estado') ?>"></option>
                                    </select>
                                </div>
                                <?php if (get_field('phone-number', 'user_' . $user->ID) == '') : ?>
                                    <div class="half conditional-person">
                                        <input type="text" name="phone-number" id="phone-number">
                                        <label for="phone-number"><?php lang('Phone Number', 'Número de telefone'); ?></label>
                                    </div>
                                <?php endif; ?>
                                <?php if (get_field('facebook', 'user_' . $user->ID) == '') : ?>
                                    <div class="conditional-person">
                                        <input type="text" name="facebook" id="facebook">
                                        <label for="facebook">Facebook</label>
                                    </div>
                                <?php endif; ?>
                                <!-- <div class="conditional-organization"></div> -->
                                <div style="margin-top: 5px;">
                                    <input type="checkbox" name="terms" id="terms">
                                    <label for="terms"><?php lang('I read and agree to the <a onclick="terms()">terms and conditions</a>', 'Eu li e concordo com os <a onclick="terms()">termos e condições</a>'); ?></label>
                                </div>
                                <div class="submit">
                                    <button class="primary-button"><?php lang('Submit', 'Enviar'); ?></button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <?php
        echo '<script>window.location.href = "' . home_url() . '?login=true";</script>';
        ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>