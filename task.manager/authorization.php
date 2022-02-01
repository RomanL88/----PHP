<div class="index-auth">
    <form action="?login=yes" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="iat">
                    <label for="login_id">Ваш e-mail:</label>
                    <input id="login_id" size="30" name="login" value="<?= $userLoginSent ?>"> // подставить данные, которые вводил пользователь (тенарный оператор)
                </td>
            </tr>
            <tr>
                <td class="iat">
                    <label for="password_id">Ваш пароль:</label>
                    <input id="password_id" size="30" name="password" type="password" value="<?= $userPasswordSent ?>"> // подставить данные, которые вводил пользователь (тенарный оператор)
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Войти"></td>
            </tr>