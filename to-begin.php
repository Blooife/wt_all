<?php
require_once 'vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


$title = "To begin";
$template = 'to-begin.html.twig';
$style = "To-begin.css";

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';

$href ="";
$text="";
session_start();
if(isset($_SESSION['username'])){
    $href = "LogOut.php";
    $text = "Log Out";
}
else{
    $href = "SignIn.php";
    $text = "Log In / Register";
}

try {
    $db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $sth = $db->prepare("SELECT * FROM `tobegin-db`");
    $sth->execute();
    $poses = $sth->fetchAll(PDO::FETCH_ASSOC);
    $num = count($poses);

    echo $twig->render("base.html.twig", [
        'title' =>$title,
        'template' =>$template, 'style' =>$style, 'poses'=>$poses, 'href'=>$href,'text'=>$text,'num'=>$num,
    ]);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}







