<?php

$host = 'localhost';
$dbname = 'test';
$username = 'root';
$password = '';
$db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $db->prepare("SELECT * FROM `tobegin-db`");
$sth->execute();
$all = $sth->fetchAll(PDO::FETCH_ASSOC);
$st = $db->prepare("INSERT INTO `tobegin-db` (src, posename, text, descr, steps) VALUES (:src,:posename, :text, :descr, :steps)");
$params = [
    ':src' => $_POST['image'],
    ':posename' => $_POST['name'],
    ':text' => $_POST['text'],
    ':descr' => $_POST['descr'],
    ':steps' => $_POST['steps']
];
$bool = true;
foreach ($all as $el){
    if($el['posename']==$_POST['name']){
        echo "<script>alert(\"The record with such name already exists\");window.location = 'edit.php';</script>";
        $bool = false;
    }
}
try{
    if($bool)
        $st->execute($params);
    echo "<script>alert(\"The record was successfully added\");window.location = 'edit.php';</script>";
}catch (PDOException $ex){
    echo $ex;
}