<?php
require_once 'vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


$title = "Signing";
$template = 'signing.html.twig';
$style = "signing.css";
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
session_start();
$href ="";
$text="";
if(isset($_SESSION['username'])){
    $href = "LogOut.php";
    $text = "Log Out";
}
else{
    $href = "SignIn.php";
    $text = "Log In / Register";
}

if (isset($_POST['loginUp']))
{
// получаем данные из формы с авторизацией
    $login = $_POST['loginUp'];
    $bd = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
    //echo "3";
    $bd->execute(array('username'=>$login));
    $count = -1;
   // $count = $bd->fetchColumn();
    $row = $bd->fetch(PDO::FETCH_ASSOC);
    if ($row['id']>0) {
        echo "<script>alert(\"This username is registered already\");</script>";
    }
    else{
        $password = $_POST['passwordUp'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $bd = $pdo->prepare("INSERT INTO `users` (username, password) VALUES (:username, :password)");
        $bd->bindParam(':username', $login);
        $bd->bindParam(':password', $hashedPassword);
        $bd->execute();
        echo "<script>alert(\"You've been registered successfully\");window.location = 'index.php';</script>";
    }
}

if(isset($_POST['loginIn'])){
    $username = $_POST['loginIn'];
    $password = $_POST['passwordIn'];
    $bd = $pdo->prepare('SELECT username, password FROM users WHERE username = :username');
    $bd->bindParam(':username', $username);
    $bd->execute();
    $user = $bd->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        echo "<script>alert(\"You're in\");window.location = 'index.php';</script>";
    } else {
        echo "<script>alert(\"Wrong password\");window.location = 'SignIn.php';</script>";
    }
}

echo $twig->render("base.html.twig", [
    'title' =>$title,
    'template' =>$template, 'style' =>$style,'href'=>$href,'text'=>$text,
]);