<?php
session_start(); //Запускаем сессии



//ЗАДАНИЕ 4.3 
//Неавторизованный пользователь теперь может просматривать только главную страницу и страницу с формой авторизации. 
// проверка авторизации для доступа на другие страницы
//устанавливаем на каждой странице, кроме индексной
function logged_in()
{
    return (isset($_SESSION['is_auth'])) ? true : false;
}

// напишу на странице, на которую нельзя заходить неавторизованным 

/* if (logged_in() === false) {
    echo "Вы не залогинены, Вам сюда нельзя";
    //редирект на главную страницу
    header('Location: https://www/task.manager/index.php ');

}; */



// удаление сессии
function destroySession()
{
    if (session_id()) {
        // Если есть активная сессия, удаляем куки сессии,
        setcookie(session_name(), session_id(), time() - 60 * 60 * 24);
        // и уничтожаем сессию
        session_unset();
        session_destroy();
    }
}

//ПРОДЛЕНИЕ СЕССИИ
function startSession($isUserActivity = true)
{
    $sessionLifetime = 300;

    if (session_id()) return true;
    // Устанавливаем время жизни куки до закрытия браузера (контролировать все будем на стороне сервера)
    //ini_set('session.cookie_lifetime', 0);

    if (!session_start()) return false;

    $t = time();

    if ($sessionLifetime) {
        // Если таймаут отсутствия активности пользователя задан,
        // проверяем время, прошедшее с момента последней активности пользователя
        // (время последнего запроса, когда была обновлена сессионная переменная lastactivity)
        if (isset($_SESSION['lastactivity']) && $t - $_SESSION['lastactivity'] >= $sessionLifetime) {
            // Если время, прошедшее с момента последней активности пользователя,
            // больше таймаута отсутствия активности, значит сессия истекла, и нужно завершить сеанс
            destroySession();
            return false;
        } else {
            // Если таймаут еще не наступил,
            // и если запрос пришел как результат активности пользователя,
            // обновляем переменную lastactivity значением текущего времени,
            // продлевая тем самым время сеанса еще на sessionLifetime секунд
            if ($isUserActivity) $_SESSION['lastactivity'] = $t;
        }
    }

    return true;
}

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

                $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
                $_SESSION["login"] = $log; //Записываем в сессию логин пользователя

                //устанавливаю жизнь куки +1 месяц
                setcookie('login', $log['login'], time() + 60 * 60 * 24 * 30); //логин

                startSession();
                return $correctUserData = true;



                //написать логику, чтобы передавало значение тру в авторизацию, чтобы там подключались файлы, перенести инклуды туда

                //include __DIR__ . '/../include/success_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ УСПЕШНОЙ АВТОРИЗАЦИИ ( /include/success_message.php )

            } else {
                $_SESSION["is_auth"] = false;
                echo 'Вы не авторизованы!';



                return $correctUserData = false;

                break;
            }
        } else {
            $_SESSION["is_auth"] = false;

            //include __DIR__ . '/../include/error_message.php'; // ПОДКЛЮЧАЮ ФАЙЛ СО ЗНАКОМ ОБ ошибке (/include/error_message.php )

            return $correctUserData = false;
        }
    }
}
