<?php
//ПРОВЕРКА ОТПРАВКИ ФОРМЫ
// если метод отправки пост и введён пароль и введён логин, то подключаем файлы с логинами и паролями на странице авторизации.
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['password']) &&  isset($_POST['login'])) {

    user_data_check($_POST['login_id'], $_POST['password_id']);        //вызов проверки данных пользователя
}

function user_data_check($login_id, $password_id)
{

    include __DIR__ . '/../data/passwords.php';       //подключаем пароли
    include __DIR__ . '/../data/users.php';       //подключаем логины

    $userData = array_combine($userLogins, $userPasswords); // проверяем данные пользователя

    foreach ($userData as $log => $pass) {

        if ($log == $login_id) {

            if ($pass == $password_id) {

                include __DIR__ . '/include/success_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ УСПЕШНОЙ АВТОРИЗАЦИИ ( /include/success_message.php )

            } else {

                include __DIR__ . '/../include/error_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ УСПЕШНОЙ АВТОРИЗАЦИИ (/include/error_message.php )

                $userLoginSent = (true) ? $_POST['login_id'] : ' ';        // ДАННЫЕ  -> ОТПРАВЛЕННЫЕ ПОЛЬЗОВАТЕЛЕМ
                $userPasswordSent = (true) ? $_POST['password_id'] : ' ';
            }
        }
    }
}
