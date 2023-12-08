<?php
require_once (__DIR__ . '/server.php');
?>
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        <?= file_get_contents("style.css") ?>
    </style>

    <title>Document</title>
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="register-form">
<!--            <input type="text" placeholder="name"/>-->
<!--            <input type="password" placeholder="password"/>-->
<!--            <input type="text" placeholder="email address" name="email"/>-->
<!--            input-->
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form class="login__form" method="POST">
            <input type="text" placeholder="username" name="username"/>
            <input type="email" name="email" id="">
            <input type="password" placeholder="password" name="password"/>
            <input type="submit" value="Register" id="submit" name="register">
<!--            <p class="message">Not registered? <a href="#">Create an account</a></p>-->
        </form>
    </div>
</div>
</body>
</html>
