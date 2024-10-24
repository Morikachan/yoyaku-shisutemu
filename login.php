<?php
session_start();
// login.htmlから値を貰う
$mail = $_POST['mail'];
$passwd = $_POST['passwd'];
$passHash = password_hash($passwd, PASSWORD_DEFAULT);
$hash = '$2y$10$DYQDr/r6cgbqW0Dk84jJoOTS7Wl7FnHljvR6/aJt.TcGjYIhT0j4W';

$_SESSION['mail'] = $mail;
$_SESSION['passwd'] = $passwd;
echo "入力されたメールは、$mail";
echo "</br>";
echo "入力されたパスワードは、$passHash";
echo "</br>";

if (password_verify($passwd, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

//header("Location: mypage.html");
exit();
?>