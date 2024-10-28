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
echo "</br>";

if (password_verify($passwd, $hash)) {
    echo 'パスワードの認証に成功しました';
    echo "</br>";
    echo "3秒後にリダイレクトします";
    header("refresh:3; mypage/mypage.html");
} else {
    echo 'Invalid password.';
}
exit();
?>