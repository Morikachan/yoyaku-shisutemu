<?php
session_start();
// require_once '../../core/Database.php';

// テストデータの記入内容
/* -------------------
    adminId   = 1        
    passwd = test
------------------- */
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーここから下は消す予定ーーーーーーーーーーーーーーーーーーーーーーーーーーーー
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'test';
function getDbConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . 
        ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    }
}
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

function selectUserData($pdo,$adminId) {
    $sql = "SELECT * FROM admin_info WHERE adminId = :adminId";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':adminId',$adminId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = getDbConnection();
    $adminId = $_POST['adminID'];
    $passwd = $_POST['passwd'];
    $user = selectUserData($pdo,$adminId);
    if (!$user) {
        $_SESSION['error'] = '入力されたIDが見つかりませんでした';
        header("Location: ./admin_login.php");
        exit;
    } else if ($user && password_verify($passwd,$user['adminPass'])) {
        header("Location: ../get_data/get_data.php");
        exit;
    } else {
        $_SESSION['error'] = 'パスワードが違います';
        header("Location: ./admin_login.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>ログイン</title>
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
            <?php if(isset($_SESSION['error'])) :?>
                <div class="error-message">
                    <?php echo $_SESSION['error']?>
                </div>
            <?php 
            unset($_SESSION['error']);?>
            <?php endif;?>
            <div class="content-container">
                <form action="./admin_login.php" method="post">
                    <h3>管理者ID</h3>
                    <input type="text" name="adminID" id="adminID">
                    <h3>パスワード</h3>
                    <input type="password" name="passwd" id="passwd">
                    <p><a href="" class="blue-link">パスワードを忘れた方はこちら</a></p>
                    <button type="submit" class="login-submit">ログイン</button>
                </form>
                <p>アカウントをお持ちでない方は<a href="" class="blue-link">こちら</a></p>
            </div>
    </main>
</body>
</html>