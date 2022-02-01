<div class="index-auth">
    <form action="?login=yes" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="iat">
                    <label for="login_id">Ваш e-mail:</label>
                    <input id="login_id" size="30" name="login" value="$userLoginSent"> // подставить данные, которые вводил пользователь (тенарный оператор)
                </td>
            </tr>
            <tr>
                <td class="iat">
                    <label for="password_id">Ваш пароль:</label>
                    <input id="password_id" size="30" name="password" type="password" value="$userPasswordSent"> // подставить данные, которые вводил пользователь (тенарный оператор)
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Войти"></td>
            </tr>
            <?php
            //ПРОВЕРКА ОТПРАВКИ ФОРМЫ
            // если метод отправки пост и введён пароль и введён логин, то подключаем файлы с логинами и паролями на странице авторизации.
            if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['password']) &&  isset($_POST['login'])) {

                user_data_check($_POST['login_id'], $_POST['password_id']);        //вызов проверки данных пользователя
            }

            function user_data_check($login_id, $password_id)
            {

                include 'data/passwords.php';       //подключаем пароли
                include 'data/user.php';       //подключаем логины

                $userData = array_combine($userLogins, $userPasswords); // проверяем данные пользователя

                foreach ($userData as $log => $pass) {

                    if ($log == $login_id && $pass == $password_id) {

                        include __DIR__ . '/include/success_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ УСПЕШНОЙ АВТОРИЗАЦИИ ( /include/success_message.php )

                    } else {

                        include __DIR__ . '/include/error_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ УСПЕШНОЙ АВТОРИЗАЦИИ (/include/error_message.php )

                        $userLoginSent = $_POST['login_id'];        // ДАННЫЕ  -> ОТПРАВЛЕННЫЕ ПОЛЬЗОВАТЕЛЕМ
                        $userPasswordSent = $_POST['password_id'];
                    }
                }
            }

            ?>