<?php
session_start();
unset($_SESSION['username']);
session_destroy();
//echo "<script>alert(\"You're successfully loged out\");window.location = 'index.php';</script>";
header("Location: index.php");
exit();
