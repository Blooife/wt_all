<?php

require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$template = 'pose.html.twig';
$style = "style.css";
$steps = [];
$title = '';
$name = '';
$description = '';
$src = '';

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
    $text = "";
}
$ind = key($_GET);
try {
    $db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $sth = $db->prepare("SELECT * FROM `tobegin-db` WHERE `id` = :id");
    $sth->bindParam(':id',$ind);
    $sth->execute();
    $array = $sth->fetch(PDO::FETCH_ASSOC);
    $str = explode("|", $array['steps']);
    //$array['src'] = str_replace("images/", "", $array['src']);
    echo $twig->render("base.html.twig", [
        'template' =>$template, 'style' =>$style,
        'steps' => $str,
        'title' =>$array['name'], 'name' => $array['posename'],
        'description' => $array['descr'], 'src' => $array['src'],'href'=>$href,'text'=>$text,
    ]);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}











