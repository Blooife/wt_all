<?php
require_once 'vendor/autoload.php';


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);


$title = "Edit data";
$template = 'edit.html.twig';
$style = "Edit.css";
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$act = '';

session_start();

if(isset($_SESSION['username'])){
    $href = "LogOut.php";
    $text = "Log Out";
}
else{
    echo "<script>alert(\"You're not in\");window.location = '403.php';</script>";
    exit;
    $href = "SignIn.php";
    $text = "Log In / Register";
}


try {
    $db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $sth = $db->prepare("SELECT * FROM `tobegin-db` ORDER BY `id`");
    $sth->execute();
    $all = $sth->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$row['id']=0;
if(isset($_POST['edit']))
if($_POST['chooseE']){
    $name= $_POST['chooseE'];
    $sth = $db->prepare("SELECT * FROM `tobegin-db` WHERE `posename` = :posename");
    $sth->bindParam(':posename',$name);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $act = "editRec.php";
}


if(isset($_POST['add'])){
    $row['id']=1;
    $act ="add.php";
}


echo $twig->render("base.html.twig", [
    'title' =>$title,
    'template' =>$template, 'style' =>$style, 'href'=>$href,'text'=>$text, 'row'=>$row,'all'=>$all, 'act'=>$act,
]);

