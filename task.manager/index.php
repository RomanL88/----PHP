<?php
session_start(); //Запускаем сессии

include __DIR__ . '/php-logics/form-submission-validation.php' // подключаю проверку формы 
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="styles.css" rel="stylesheet">
    <title>Project - ведение списков</title>
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
</head>

<body>

    <div class="header">
        <div class="logo"><img src="i/logo.png" alt="Project"></div>
        <div class="author">Автор: <span class="author__name">Роман</span></div>
        <ul class="project-folders-v">
            <?php
            //если пользователь авторизован, то вместо ссылки авторизации будет ссылка выход
            // который должен завершать сессию и удалять куки  
            if (logged_in() === true) {
                // выводим ссылку выход
                // можно ли так делать???
                echo '<li><a href="php-logics/close.php">Выход</a></li>';
                // если нажимаем, то удаляем сессию

            } else {
                //выводим ссылку авторизации
                echo '<li class="project-folders-v-active"><a href="?login=yes" method="get">Авторизация</a></li>';
            };
            ?>
        </ul>



    </div>

    <div class="clear">
        <ul class="main-menu">
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Контакты</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Каталог</a></li>
        </ul>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="left-collum-index">

                <h1>Возможности проекта —</h1>
                <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>


            </td>
            <td class="right-collum-index">

                <div class="project-folders-menu">
                    <ul class="project-folders-v">
                        <!-- <li class="project-folders-v-active"><a href="?login=yes" method="get">Авторизация</a></li> -->
                        <li><a href="#">Регистрация</a></li>
                        <li><a href="#">Забыли пароль?</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <?php
                if (isset($_GET['login']) && $_GET['login'] === 'yes') {

                    include 'authorization.php';
                }
                ?>
            </td>
        </tr>
    </table>

    <div class="clearfix">
        <ul class="main-menu bottom">
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Контакты</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Каталог</a></li>
        </ul>
    </div>

    <div class="footer">&copy;&nbsp;<nobr>2018</nobr> Project.</div>
    <?php
    var_dump($_SESSION);
    ?>

</body>

</html>