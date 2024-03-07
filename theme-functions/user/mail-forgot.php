<!DOCTYPE html>
<html lang="en" style="background-color: #000;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo custom_lang('Account verification', 'Verificação de conta'); ?></title>
    <meta name="color-scheme" content="dark">
    <meta name="supported-color-schemes" content="dark">
    <style>
        body,
        html {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        html {
            color: #000;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #fff;
            margin-top: 0;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .content {
            margin-bottom: 20px;
        }

        .content p {
            margin-bottom: 10px;
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 30px;
            margin-top: 30px;
            background-color: #fff;
            color: #000;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
        }

        @media (prefers-color-scheme: light) {

            body,
            .container,
            html {
                background-color: #000;
                color: #000;
            }
        }

        @media (prefers-color-scheme: dark) {

            body,
            .container,
            html {
                background-color: #000;
                color: #000;
            }
        }
    </style>
</head>

<body style="background-color: #000;width:100%;">
    <div class="container" style="width: 100%;height: 100%;margin: 0 auto;padding: 0;">
        <div class="wrapper" style="width: 400px;margin: 0 auto;display:block;">
            <div class="header">
                <img style="max-width: 200px;padding-top:40px;" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 263 59'%3E%3Cg fill='%23fff' clip-path='url(%23a)'%3E%3Cpath d='M79.1 48.4h-8.9V32.3L61.2 0h8.3l3.8 14.7 1.2 8.5h.3l1.3-8.5L79.8 0h8.4l-9 32.3v16.1ZM106.3 48.4H93c-4-4.3-6.1-10.1-6.1-17.6A27 27 0 0 1 92.7 13h14.2c2.1 2.8 3.6 5.5 4.4 8.1.7 2.6 1.1 5.9 1.1 9.7 0 7.5-2 13.3-6 17.6Zm-9-7.2h4.7c1.5-3.3 2.2-7 2.2-11 0-4.1-.8-7.4-2.3-9.9h-4.6a19 19 0 0 0-2.2 10c0 4.4.8 8 2.2 10.9ZM127.6 48.4h-6.4c-1.8-2.6-3-5.2-3.6-7.7-.7-2.6-1-5.8-1-9.7V13h8.1v18.7c0 4.2.7 7.3 2.2 9.4h5.7v-28h8.1v35.3h-6.4l-1.1-2.5a7.4 7.4 0 0 1-5.6 2.5ZM146.3 48.4V0h8.3v40.4h12.8v8h-21.1ZM189.8 48.4h-13.3c-4.1-4.3-6.1-10.1-6.1-17.6 0-3.7.4-7 1.3-9.7a27 27 0 0 1 4.4-8h14.3c2.1 2.7 3.6 5.4 4.3 8 .8 2.6 1.2 5.9 1.2 9.7 0 7.5-2 13.3-6.1 17.6Zm-9-7.2h4.7c1.4-3.3 2.2-7 2.2-11 0-4.1-.8-7.4-2.3-9.9h-4.6a19 19 0 0 0-2.2 10c0 4.4.7 8 2.2 10.9ZM202.4 13h13.5v7.3h-9.5l5.8 9.8c2.6 4.2 4 7 4.3 8.6.2.8.2 1.5.2 2.3 0 3.3-1 5.7-3.2 7.4H198v-7.2h11.2l-6.5-10.9a52.4 52.4 0 0 0-2.7-4.4 15 15 0 0 1-1.2-2.3l-.4-1.2a12 12 0 0 1-.3-2.1c0-3.4 1.5-5.8 4.4-7.2ZM222.5 33V20.3h-4.2v-7.2h4.2V3.5h8.2V13h5v7.2h-5v14.9c0 2.8.4 4.8 1.2 6h3.8v7.2H227a14 14 0 0 1-4-7.3c-.3-2.2-.5-5-.5-8.1ZM239 29V13h8.1v16c0 4 .7 7.4 2.2 10h3.6c1.3-2.6 2-5.9 2-10V13h8.1v15.5c0 3.5-.4 6.5-1.2 9.1-.8 2.6-2 5.6-3.9 9l-4 7.5c-.8 1.4-1.6 2.5-2.4 3.2-.8.6-1.9 1.2-3.2 1.5h-9.6v-7.3h6.6c.8-.3 1.5-.7 2.1-1.4.6-.7 1.2-1.7 1.8-3l.3-.8h-4.2c-2-1.8-3.5-4.2-4.6-7.3-1.2-3-1.7-6.4-1.7-10ZM27.2 30a1 1 0 0 1-.6-.1 1 1 0 0 1-.2-1.5L42.1 7.3H31.4l-6.8 10.2a1 1 0 0 1-1.4.3 1 1 0 0 1-.3-1.4l7-10.7c.3-.3.6-.5 1-.5H44c.4 0 .8.2 1 .6 0 .3 0 .8-.2 1L28 29.7a1 1 0 0 1-.8.4ZM15.9 28.3a1 1 0 0 1-.8-.4L.1 7a1 1 0 0 1 0-1c.2-.4.5-.6.9-.6h16c.3 0 .7.2.8.5l3.2 6.5c.3.4 0 1-.4 1.3-.5.2-1 0-1.3-.5l-3-5.9H3l13.8 19.6a1 1 0 0 1-.8 1.5Z'/%3E%3Cpath d='M15.9 39.5a1 1 0 0 1-1-1V27.9l.2-.6 5.2-6.7a1 1 0 0 1 1.3-.2c.4.4.5 1 .2 1.4l-5 6.4v10.3c0 .5-.4 1-.9 1ZM41.7 44.5H16c-.6 0-1-.5-1-1 0-.7.4-1.2 1-1.2h24.6v-7.6H26c-.6 0-1-.5-1-1.2 0-.6.4-1 1-1h15.7c.6 0 1 .4 1 1v10c0 .5-.4 1-1 1Z'/%3E%3C/g%3E%3Cdefs%3E%3CclipPath id='a'%3E%3Cpath fill='%23fff' d='M0 0h263v58.8H0z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E">
                <h1 style="color: #fff;"><?php echo custom_lang('Password reset', 'Redefinição de senha') ?></h1>
            </div>
            <div class="content">
                <p style="color: #fff;"><?php echo custom_lang('Please use the code below to reset your password.', 'Por favor, utilize o código abaixo para redefinir sua senha:') ?></p>
                <p style="color: #fff;font-size: 40px;margin-top:30px;margin-bottom:30px;font-weight:bold;"><?php echo $hash ?></p>
                <p style="color: #fff;"><?php echo custom_lang('If you did not request a password reset, please ignore this email.', 'Caso não tenha solicitado a recuperação de senha, por favor, ignore este e-mail.') ?></p><br>
            </div>
            <div class="footer">
                <p style="color: #fff;">YouLosty</p>
            </div>
        </div>
    </div>
</body>

</html>