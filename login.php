<?php
session_start();

$mail = $_POST['mail'];
$passwd = $_POST['passwd'];
//$passHash;
$_SESSION['mail'] = $mail;
$_SESSION['passwd'] = $passwd;

header("Location: mypage.html");
exit();
?>