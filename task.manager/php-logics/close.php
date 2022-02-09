<?php
session_start();
$_SESSION = [];
session_destroy();
header("Location: https://www/task.manager/index.php");
