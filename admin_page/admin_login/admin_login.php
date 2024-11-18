<?php
session_start();
// require_once '../../core/Database.php';

// テストデータの記入内容
/* -------------------
    adminId   = 1        
    passwd = aaa
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
    // if(!$adminId) {
    //     $_SESSION['error2'] = 'IDを入力してください';
    // } else if (!$passwd) {
    //     $_SESSION['error2'] = 'パスワードを入力してください';
    // }
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
    <link rel="stylesheet" href="./style.css">
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

        <div class="content-container"><!-- ここから下に➀のコード -->
            <form action="./admin_login.php" method="post">
                <label for="adminID"><h3>管理者ID</h3></label>
                <input type="text" id="adminID" name="adminID" oninput="checkInput()"><br>
                <span id="adminIDError" style="color:red; display:none;">管理者IDを入力してください。</span><br>

                <label for="passwd"><h3>パスワード</h3></label>
                <input type="password" id="passwd" name="passwd" oninput="checkInput()"><br>
                <span id="passwdError" style="color:red; display:none;">パスワードを入力してください。</span><br>

                <button type="submit" class="login-submit">ログイン</button>
            </form><!-- ここまで➀のコード -->

            <script>
                function checkInput() {
                    // 管理者IDとパスワードのフィールドの値を取得
                    let adminID = document.getElementById('adminID').value;
                    let passwd = document.getElementById('passwd').value;

                    // 管理者IDが入力されていない場合、エラーメッセージを表示
                    if (adminID === "") {
                        document.getElementById('adminIDError').style.display = 'inline';
                    } else {
                        document.getElementById('adminIDError').style.display = 'none';
                    }

                    // パスワードが入力されていない場合、エラーメッセージを表示
                    if (passwd === "") {
                        document.getElementById('passwdError').style.display = 'inline';
                    } else {
                        document.getElementById('passwdError').style.display = 'none';
                    }
                }
            </script>
            
            <p>アカウントをお持ちでない方は<a href="" class="blue-link">こちら</a></p>
        </div>
    </main>
</body>
</html>

<!-- 過去のコード➀
    <form action="./admin_login.php" method="post">
    <h3>管理者ID</h3>
    <input type="text" name="adminID" id="adminID">
    <?php //if(isset($_SESSION['error2'])) :?>
        <div class="error-message2">
            <?php //echo $_SESSION['error2']?>
        </div>
        <?php //unset($_SESSION['error2']);?>
    <?php //endif;?>
    <h3>パスワード</h3>
    <input type="password" name="passwd" id="passwd">
    <p><a href="" class="blue-link">パスワードを忘れた方はこちら</a></p>
    <button type="submit" class="login-submit">ログイン</button>
    </form>
-->