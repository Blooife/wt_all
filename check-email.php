<?php
function check($email) {
    return (preg_match("/\w+@\w+(\.\w+)+/", $email));
}

require_once("Mailer.php");
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$message = preg_replace('/(https?:\/\/(?!((\S+\.)?(bsuir\.by)))\S+)/', '#Внешние ссылки запрещены#', $message);

if($name != "" && $email != "" && $message != ""){
    if(check($email)){
        $file = 'email.txt';
        $data = $name . ', ' . $email . ', ' . $message . PHP_EOL;
        file_put_contents($file, $data, FILE_APPEND);
        if(send("blooifeman@yandex.ru", "yoga", "$email", $name, "yoga", "Thanks for your feedback, $name! We will reply soon.")){
            echo "<script>alert(\"Message was sent successfully!\");window.location = 'index.php';</script>";
        }
    }else{
        echo "<script>alert(\"Wrong email!\");window.location = 'index.php';</script>";
    }

}else{
    echo "<script>alert(\"Fill in all the fields\");window.location = 'index.php';</script>";
}


