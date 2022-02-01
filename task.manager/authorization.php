<div class="index-auth">
    <form action="?login=yes" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="iat">
                    <?php // перенести сюда инклуд 
                    if ($correctUserData == true) {
                        //ПОДКЛЮЧАЕМ ИНКЛУД
                        include __DIR__ . '/include/success_message.php';
                    } else {
                        //ПОДКЛЮЧАЕМ ДРУГОЙ ИНКЛУД
                        include __DIR__ . '/include/error_message.php';
                    }
                    ?>
                    <label for="login_id">Ваш e-mail:</label>
                    <input id="login_id" size="30" name="login" value="<?= $userLoginSent ?>">
                </td>
            </tr>
            <tr>
                <td class="iat">
                    <label for="password_id">Ваш пароль:</label>
                    <input id="password_id" size="30" name="password" type="password" value="<?= $userPasswordSent ?>">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Войти"></td>
            </tr>
        </table>
    </form>
</div>