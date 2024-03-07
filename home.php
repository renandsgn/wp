<?php /* Template name: Home */ ?>
<?php if (is_user_logged_in()) {
    if (wp_get_current_user()->roles[0] == 'subscriber')
        wp_redirect(site_url()  . (wpm_get_language() != 'en' ? '/pt-br/panel' : '/panel'));
}
if (isset($_GET['login']) && $_GET['login'] == 'true') {
    echo "<script>let loginFormType = true;</script>";
} else {
    echo "<script>let loginFormType = false;</script>";
}
?>

<?php get_header(); ?>
<main>
    <section class="wrapper">
        <div class="container">
            <div class="left">
                <div>
                    <h1 class="primary-title"><?php echo wpm_get_language() == 'en' ? preg_replace('/,/', ',<br>', get_field('sobre-title')) : get_field('sobre-title'); ?></h1>
                    <?php the_field('sobre-text'); ?>
                    <a href="<?php the_field('sobre-link'); ?>"><?php the_field('sobre-text-link'); ?></a>
                </div>
            </div>
            <div class="right">
                <div class="tabs">
                    <div class="active-tab"><?php lang('Signup', 'Cadastre-se') ?></div>
                    <div><?php lang('Login', 'Entrar') ?></div>
                </div>
                <div class="tab-content">
                    <div class="tab-active tab-left">
                        <a href="login-facebook.php?action=signup" class="primary-button"><img src="<?php path('img/fb.svg'); ?>" alt="Facebook icon"><?php lang('Signup with Facebook', 'Registrar-se com Facebook'); ?></a>
                        <hr>
                        <div class="wrapper-form register-form">
                            <div>
                                <input data-type="mail" type="text" name="usrlgn" id="usrlgn">
                                <label for="usrlgn">Email</label>
                            </div>
                            <div>
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
                            <div>
                                <input data-type="password-confirm" type="text" onfocus="initPasswordInputType(this)" name="pswlgn2" id="pswlgn2">
                                <label for="pswlgn2"><?php lang('Confirm password', 'Confirme a senha'); ?></label>
                                <div class="eye">
                                    <img src="<?php path('img/eye-open.svg'); ?>" alt="olho aberto">
                                    <img src="<?php path('img/eye-close.svg'); ?>" alt="olho fechado">
                                </div>
                            </div>
                            <div>
                                <button class="primary-button submit"><?php lang('Submit', 'Enviar'); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-inactive tab-right">
                        <a href="login-facebook.php?action=signup" class="primary-button"><img src="<?php path('img/fb.svg'); ?>" alt="Facebook icon"><?php lang('Signin with Facebook', 'Entrar com Facebook'); ?></a>
                        <hr>
                        <div class="wrapper-form login-form">
                            <div>
                                <input type="text" data-type="mail" name="usrwplgn" id="usrwplgn">
                                <label for="usrwplg">Email</label>
                            </div>
                            <div>
                                <input autocomplete="off" data-type="password" type="text" onfocus="initPasswordInputType(this)" onfocus="this.type='password'" name="pswwplgn" id="pswwplgn">
                                <label for="pswwplgn"><?php lang('Password', 'Senha'); ?></label>
                                <div class="eye">
                                    <img src="<?php path('img/eye-open.svg'); ?>" alt="olho aberto">
                                    <img src="<?php path('img/eye-close.svg'); ?>" alt="olho fechado">
                                </div>
                            </div>
                            <div>
                                <a style="display: table;margin-bottom: 15px;color: #4f4f4f;" href="<?php echo home_url('forgot-password'); ?>"><?php lang('Fogot your password?', 'Esqueceu sua senha?'); ?></a>
                                <button class="primary-button submit"><?php lang('Enter', 'Entrar'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>