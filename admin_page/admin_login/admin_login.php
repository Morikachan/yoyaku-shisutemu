<?php
session_start();
// もし既にログインされているなら
if (isset($_SESSION['logged'])){
    header("Location: ../user_information/user_information.php");
    exit;
}
require_once '../../core/Database.php';

// テストデータの記入内容
/* -------------------
    adminId   = 1        
    passwd = aaa
------------------- */
function selectUserData($pdo,$adminId) {
    $sql = "SELECT * FROM admin_info WHERE adminId = :adminId";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':adminId',$adminId,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = Database::getInstance();
    $pdo = $db -> getPDO();
    $adminId = $_POST['adminID'];
    $passwd = $_POST['passwd'];
    $user = selectUserData($pdo,$adminId);
    if(empty($user) || !password_verify($passwd,$user['adminPass'])){
        $_SESSION['error'] = 'IDまたはパスワードが違います</br>もう一度やり直してください。';
    } else if (isset($user) && password_verify($passwd,$user['adminPass'])) {
        $_SESSION['logged'] = true;
        header("Location: ../user_information/user_information.php");
        exit;
    }
    header("Location: ./admin_login.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="./style.css">
    <title>管理者ログイン</title>
</head>
<body>
    <header class="c-header c-hamburger-menu"><!-- 追記 クラスを追記 -->
        <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../../img/image 1.png" alt="Arts_Logo"></a>
        <div class="flex">
            <a href="#" class="red-button">お問い合わせ</a>
        </div>
    </header>
    <main>
        <h1>管理者メニュー</h1>
        <div class="content-container">
            <?php if(isset($_SESSION['error'])) :?>
                <div class="error-message">
                    <?php echo $_SESSION['error']?>
                </div>
            <?php 
            unset($_SESSION['error']);?>
            <?php endif;?>
            <form action="./admin_login.php" method="post">
                <label for="adminID"><h3>管理者ID</h3></label>
                <input type="text" id="adminID" name="adminID"><br>
                <span class="inputErrorMess" id="adminIDError">管理者IDを入力してください。</span><br>

                <label for="passwd"><h3>パスワード</h3></label>
                <input type="password" id="passwd" name="passwd"><br>
                <span class="inputErrorMess" id="passwdError">パスワードを入力してください。</span><br>
                <p><a href="./pass_reset/pass_reset.html" class="blue-link">パスワードを忘れた方はこちら</a></p>

                <button type="submit" class="login-submit">ログイン</button>
            </form>

            <script>
                // 管理者IDとパスワードのフィールドの値を取得
                const adminID = document.getElementById('adminID');
                const passwd = document.getElementById('passwd');

                adminID.addEventListener('focusout', () => {
                    // 管理者IDが入力されていない場合、エラーメッセージを表示
                    if (adminID.value === "") {
                        document.getElementById('adminIDError').style.display = 'inline-block';
                        document.getElementById('adminID').style.backgroundColor = '#FF8989';
                    } else {
                        document.getElementById('adminIDError').style.display = 'none';
                        document.getElementById('adminID').style.backgroundColor = '#FFFFFF';
                    }
                })

                passwd.addEventListener('focusout', () => {
                    // パスワードが入力されていない場合、エラーメッセージを表示
                    if (passwd.value === "") {
                        document.getElementById('passwdError').style.display = 'inline-block';
                        document.getElementById('passwdError').style.marginBottom = '20px';
                        document.getElementById('passwd').style.backgroundColor = '#FF8989';
                    } else {
                        document.getElementById('passwdError').style.display = 'none';
                        document.getElementById('passwd').style.backgroundColor = '#FFFFFF';
                    }
                })
            </script>
        </div>
    </main>
</body>
</html>