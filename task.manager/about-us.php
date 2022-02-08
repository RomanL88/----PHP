<?php session_start();

function logged_in()
{
    return (isset($_SESSION['is_auth'])) ? true : false;
}


if (logged_in() === false) {
    //редирект на главную страницу
    header('Location: https://www/task.manager/index.php ');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT US</title>
</head>

<body>

</body>

</html>