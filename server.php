<?php
require_once (__DIR__ . '/functions/func.php');

//session_set_cookie_params()

session_start();

var_dump($_COOKIE);
if(!empty($_SESSION['user']) && (isset($_COOKIE['username']) && $_SESSION['user']['username'] == $_COOKIE['username'])){
    header("Location: /cookie_session/profile.php");
}

$dblogin = 'root';
$dbpassword = 'root';
$dbname = 'dblesson';
$host = '127.0.0.1';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

$database = null;

try {
    $database = new PDO($dsn, $dblogin, $dbpassword, $opt);
} catch(PDOException $e) {
    exit("Подключение не удалось: {$e->getMessage()}");
}

if(isset($_POST['register']) && $database != null){
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])){

        $_SESSION['user'] = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email'],
        ];

        $username = $_SESSION['user']['username'];
        $password = $_SESSION['user']['password'];
        $email = $_SESSION['user']['email'];

        $screeningUser = $database->prepare("SELECT `name` FROM users WHERE `name` = '$username' LIMIT 1");
        $screeningUser->execute();

        $dbuser = $screeningUser->fetch();

        if($dbuser == false){
            $checkuser = $dbuser;
        } else {
            $checkuser = true;
        }

        if($checkuser != $username){
            $screeningInsert = $database->prepare("INSERT INTO users(`id`, `name`, `password`, `email`) 
            VALUES ('','$username','$password','$email')");
            $screeningInsert->execute();

            $_SESSION['authUser'] = $username;

            var_dump($_SESSION);
            var_dump($_COOKIE);
            setcookie('username', $username, time() + 15,);

            header("Location: /cookie_session/profile.php");
            die();



        } else {
            echo "Такой пользователь уже существует";
        }

    } else {
        echo "Не удалось записать данные";
    }
} else {
    echo "не удалось отправить форму";
}

