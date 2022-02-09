<?php
session_start();
function destroySession()
{
    if (session_id()) {

        setcookie(session_name(), session_id(), time() - 60 * 60 * 24);

        session_unset();
        session_destroy();
    }
}


function startSession($isUserActivity = true)
{
    $sessionLifetime = 300;

    if (session_id()) return true;



    if (!session_start()) return false;

    $t = time();

    if ($sessionLifetime) {



        if (isset($_SESSION['lastactivity']) && $t - $_SESSION['lastactivity'] >= $sessionLifetime) {


            destroySession();
            return false;
        } else {




            if ($isUserActivity) $_SESSION['lastactivity'] = $t;
        }
    }

    return true;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['password']) &&  isset($_POST['login'])) {


    $correctUserData = user_data_check($_POST['login'], $_POST['password']);
}

if ($correctUserData === false) {

    $userPasswordSent = (true) ? $_POST['password'] : ' ';
    $userLoginSent = (true) ? $_POST['login'] : ' ';
}





function user_data_check($login_id, $password_id)
{
    include __DIR__ . '/../data/passwords.php';
    include __DIR__ . '/../data/users.php';

    $userData = array_combine($userLogins, $userPasswords);

    foreach ($userData as $log => $pass) {


        if ($log === $login_id) {


            if ($pass === $password_id) {

                $_SESSION["is_auth"] = true;
                $_SESSION["login"] = $log;


                setcookie('login', $log, time() + 60 * 60 * 24 * 30);

                startSession();
                return $correctUserData = true;
            } else {
                $_SESSION["is_auth"] = false;
                echo 'Вы не авторизованы!';



                return $correctUserData = false;

                break;
            }
        } else {
            $_SESSION["is_auth"] = false;



            return $correctUserData = false;
        }
    }
}
