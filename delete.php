<?php
$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($_POST['chooseD']){
    $name= $_POST['chooseD'];
    $sth = $db->prepare("DELETE FROM `tobegin-db` WHERE `posename` = :posename");
    $sth->bindParam(':posename',$name);
    $sth->execute();
    echo "<script>alert(\"Record was deleted successfully\");window.location = 'edit.php';</script>";
}