<?php
//ПРОВЕРКА ОТПРАВКИ ФОРМЫ
// если метод отправки пост и введён пароль и введён логин, то подключаем файлы с логинами и паролями на странице авторизации.
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['password']) &&  isset($_POST['login'])) {

    $correctUserData = user_data_check($_POST['login'], $_POST['password']);        //вызов проверки данных пользователя

}

if ($correctUserData === false) {

    $userPasswordSent = (true) ? $_POST['password'] : ' ';
    $userLoginSent = (true) ? $_POST['login'] : ' ';        // ДАННЫЕ  -> ОТПРАВЛЕННЫЕ ПОЛЬЗОВАТЕЛЕМ


}





function user_data_check($login_id, $password_id)
{
    include __DIR__ . '/../data/passwords.php';       //подключаем пароли
    include __DIR__ . '/../data/users.php';       //подключаем логины

    $userData = array_combine($userLogins, $userPasswords); // проверяем данные пользователя

    foreach ($userData as $log => $pass) {


        if ($log === $login_id) {

            if ($pass === $password_id) {

                return $correctUserData = true;

                //написать логику, чтобы передавало значение тру в авторизацию, чтобы там подключались файлы, перенести инклуды туда

                //include __DIR__ . '/../include/success_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ УСПЕШНОЙ АВТОРИЗАЦИИ ( /include/success_message.php )

            } else {
                return $correctUserData = false;

                break;
            }
        } else {

            //include __DIR__ . '/../include/error_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ ошибке (/include/error_message.php )

            return $correctUserData = false;
        }
    }
}
