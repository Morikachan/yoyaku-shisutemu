<?php
session_start();
// login.htmlから値を貰う
$adminID = $_POST['adminID'];
$passwd = $_POST['passwd'];
$passHash = password_hash($passwd, PASSWORD_DEFAULT);
$hash = '$2y$10$DYQDr/r6cgbqW0Dk84jJoOTS7Wl7FnHljvR6/aJt.TcGjYIhT0j4W';

$_SESSION['adminID'] = $adminID;
$_SESSION['passwd'] = $passwd;
echo "入力されたIDは、$adminID";
echo "</br>";
echo "入力されたパスワードは、$passHash";
echo "</br>";

if (password_verify($passwd, $hash)) {
    echo 'パスワードの認証に成功';
} else {
    echo 'パスワードが違います';
}

//header("Location: mypage.html");
exit();
?>