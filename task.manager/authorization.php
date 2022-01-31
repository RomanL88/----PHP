<?php
echo'	
<div class="index-auth">
<form action="https://task.manager/index.php?login=yes" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="iat">
                <label for="login_id">Ваш e-mail:</label>
                <input id="login_id" size="30" name="login">
            </td>
        </tr>
        <tr>
            <td class="iat">
                <label for="password_id">Ваш пароль:</label>
                <input id="password_id" size="30" name="password" type="password">
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Войти"></td>
        </tr>';

        if (!empty($_POST)){ // проверка на непустое поле

            require __DIR__ . '/users.php'; // подключаю логины
            require __DIR__ . '/passwords.php'; // подключаю пароли

            $login = $_POST['login_id'] ?? ''; 
            $password = $_POST['password_id'] ?? '';

            $user = array_combine($login, $password);
            echo $user;

           /*  if () */

        } else {

/*             require '..' . __DIR__ . 'error_message.php';
 */
        }

function checkAuth( string $login, string $password): bool {

    

}

?>