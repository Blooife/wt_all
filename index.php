<?php
require_once 'vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


$title = "Yoga is for everyone";
$template = 'index.html.twig';
$style = "Main.css";
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

echo $twig->render("base.html.twig", [
    'title' =>$title,
    'template' =>$template, 'style' =>$style,'href'=>$href,'text'=>$text,
]);





