<?php
session_start(); //открытие сессии 
$_SESSION = [];
session_destroy(); //удаление сессии 
header("Location: https://www/task.manager/index.php");//Перенаправление на эту страницу после нажатия кнопки ВЫЙТИ 
