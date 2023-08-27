<?php
    $host = 'localhost';
    $dbname = 'test';
    $username = 'root';
    $password = '';
    $db = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_POST['id'];
    $src = $_POST['image'];
    $posename = $_POST['name'];
    $text = $_POST['text'];
    $descr = $_POST['descr'];
    $steps = $_POST['steps'];
    $st= $db->prepare("UPDATE `tobegin-db` SET src='$src', text = '$text', descr = '$descr', steps='$steps' WHERE `id` = :id");
    $st->bindParam(':id', $id);
    try{
        $st->execute();
        header("Location: edit.php");
    }catch (PDOException $ex){
        echo $ex;
    }
