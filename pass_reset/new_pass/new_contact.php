
<?php 
session_set_cookie_params(60 * 5);
//session利用開始
session_start();
$token = isset($_GET['token']) ? $_GET['token'] : '';
$_SESSION['token'] = $token;
?>


<p>パスワードリセット</p>


<form action="./new_pass.php" method="POST">
    <label>
        新しいパスワード
        <input type="password" name="reset_pass">
    </label>
    <br>
    <label>
        パスワード（確認用）
        <input type="password" name="repeat_pass">
    </label>
    <br>
    <button type="submit">送信する</button>
</form>