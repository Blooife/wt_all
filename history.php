<?php
require_once 'vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


$title = "History of yoga";
$template = 'history.html.twig';
$style = "History.css";

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
    $text = "Log In /Register";
}

try {
    $db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $sth = $db->prepare("SELECT * FROM `history-db` ORDER BY `id`");
    $sth->execute();
    $branches = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo $twig->render("base.html.twig", [
        'title' =>$title,
        'template' =>$template, 'style' =>$style,
        'elements' => $branches, 'href'=>$href,'text'=>$text,
    ]);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


