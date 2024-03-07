<?php
if (is_user_logged_in()) {
    if (wp_get_current_user()->roles[0] == 'subscriber')
        wp_redirect(site_url()  . (wpm_get_language() != 'en' ? '/pt-br/panel' : '/panel'));
}
get_header(); ?>
<main>
    <div class="wrapper">
        <div class="container">
            <div class="wrapper-form forgot-form">
                <h1 class="primary-title"><?php lang('Reset your password', 'Redefina sua senha') ?></h1>
                <div class="mail-field">
                    <input type="text" data-type="mail" name="usrwplgn" id="usrwplgn">
                    <label for="usrwplg">Email</label>
                </div>
                <h3 class="reset-code"><?php lang('Enter the code we sent to your email', 'Digite o código que enviamos para o seu e-mail'); ?></h3>
                <?php for ($i = 0; $i < 6; $i++) : ?>
                    <div class="reset-code">
                        <?php if ($i == 0) : ?>
                        <?php endif; ?>
                        <input type="tel" data-type="number" name="reset-code-<?php echo $i; ?>" id="reset-code-<?php echo $i; ?>" maxlength="1">
                        <label style="display: none;" for="reset-code-<?php echo $i; ?>"><?php echo $i + 1; ?></label>
                    </div>
                <?php endfor; ?>
                <div class="reset-code full">
                    <h3 class="countdown" style="margin-bottom: 10px;margin-top:10px;"><?php lang('Wait 50 seconds to try again', 'Aguarde 50 segundos para tentar novamente'); ?></h3>
                    <h3 class="resend-trigger" style="cursor: pointer;" disabled><?php lang('Code not received? Click here', 'Código não recebido? Clique aqui') ?></h3>
                </div>
                <div>
                    <button class="primary-button submit"><?php lang('Next', 'Próximo'); ?></button>
                </div>
                <button disabled class="reset-code primary-button send-code-button">Enviar</button>
                <div class="loading">
                    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                        <path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                        </path>
                    </svg>
                </div>
            </div>
            <div class="pwd-content wrapper-form" style="display: none;">
                <h1 class="primary-title"><?php lang('Reset your password', 'Redefina sua senha') ?></h1>
                <input type="hidden" name="email">
                <div style="margin-bottom: 20px;">
                    <input data-type="password" autocomplete="off" type="text" onfocus="initPasswordInputType(this)" onfocus="this.type='password'" name="pswlgn" id="pswlgn">
                    <label for="pswlgn"><?php lang('Password', 'Senha'); ?></label>
                    <div class="eye">
                        <img src="<?php path('img/eye-open.svg'); ?>" alt="olho aberto">
                        <img src="<?php path('img/eye-close.svg'); ?>" alt="olho fechado">
                    </div>
                </div>
                <span id="password-strength"></span>
                <ul class="password-specifications">
                    <li><?php lang('Minimum 01 uppercase character', 'Mínimo 01 caractere maiúsculo'); ?></li>
                    <li><?php lang('Number (0-9)', 'Numero (0-9)'); ?></li>
                    <li><?php lang('Special Character (!@#$%^&*) ', 'Caractere especial (!@#$%^&*)'); ?></li>
                    <li><?php lang('Atleast 8 Character', 'Mínimo 8 caracteres'); ?></li>
                </ul>
                <div style="margin-bottom: 20px;">
                    <input data-type="password-confirm" type="text" onfocus="initPasswordInputType(this)" name="pswlgn2" id="pswlgn2">
                    <label for="pswlgn2"><?php lang('Confirm password', 'Confirme a senha'); ?></label>
                    <div class="eye">
                        <img src="<?php path('img/eye-open.svg'); ?>" alt="olho aberto">
                        <img src="<?php path('img/eye-close.svg'); ?>" alt="olho fechado">
                    </div>
                </div>
                <div>
                    <button class="primary-button submit change-pwd-trigger"><?php lang('Submit', 'Enviar'); ?></button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>