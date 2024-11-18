<?php
session_start();
// require_once './core/Database.php';

// テストデータの記入内容
/* ---------- 記入内容 ---------
    meil   = aaa@aaa        
    passwd = test
---------------------------- */
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
function selectUserData($pdo,$mail) {
    $sql = "SELECT * FROM user_info WHERE mail = :mail";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail',$mail);
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
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];
    $user = selectUserData($pdo,$mail);
    if (!$user) {
        $_SESSION['error'] = '入力されたメールアドレスが見つかりませんでした';
        header("Location: ./login.php");
        exit;
    } else if ($user && password_verify($passwd,$user['passwd'])) {
        header("Location: ./mypage/mypage.html");
    } else {
        $_SESSION['error'] = 'パスワードが違います';
        header("Location: ./login.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./admin_page/admin_login/style.css"><!-- 後で消します(梶浦) -->
    <title>ログイン</title>
</head>
<body>
    <header class="c-header c-hamburger-menu"><!-- 追記 クラスを追記 -->
          
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="img/image 1.png" alt="Arts_Logo"></a>
            <div class="flex">
                <input type="checkbox" name="hamburger" id="hamburger" class="c-hamburger-menu__input"/><!-- 追記 idはlabelのforと同じにする -->
                <label for="hamburger" class="c-hamburger-menu__bg"></label><!-- 追記 ハンバーガーメニュを開いた時の背景 -->
                <ul class="c-header__list c-hamburger-menu__list"><!-- 追記 クラスを追記 -->
                    <li class="c-header__list-item">
                      <a href="https://www.kccollege.ac.jp/" class="c-header__list-link">ホームページへ</a>
                    </li>
                    <li class="c-header__list-item">
                      <a href="#" class="c-header__list-link">参加履歴</a>
                    </li>
                    <li class="c-header__list-item">
                      <a href="#" class="c-header__list-link">登録内容の変更</a>
                    </li>
                    <li class="c-header__list-item">
                      <a href="#" class="c-header__list-link">アカウント削除</a>
                    </li>
                    <li class="c-header__list-item">
                      <a href="#" class="c-header__list-link">お問い合わせ</a>
                    </li>
                </ul>
                <a href="#" class="red-button">新規登録</a>
            </div>
                <label for="hamburger" class="c-hamburger-menu__button"><!-- 追記 ハンバーガーメニューのボタン -->
                  <span class="c-hamburger-menu__button-mark"></span>
                  <span class="c-hamburger-menu__button-mark"></span>
                  <span class="c-hamburger-menu__button-mark"></span>
                </label>
    </header>

    <main>
        <h1>ログイン</h1>
        <?php if(isset($_SESSION['error'])) :?>
            <div class="error-message">
                <?php echo $_SESSION['error']?>
            </div>
        <?php 
        unset($_SESSION['error']);?>
        <?php endif;?>

        <div class="content-container">
            <form action="./login.php" method="post">
                <label for="mail"><h3>メールアドレス</h3></label>
                <input type="email" id="mail" name="mail" oninput="checkInput()"><br>
                <span id="mailError" style="color:red; display:none;">メールアドレスを入力してください。</span><br>

                <label for="passwd"><h3>パスワード</h3></label>
                <input type="password" id="passwd" name="passwd" oninput="checkInput()"><br>
                <span id="passwdError" style="color:red; display:none;">パスワードを入力してください。</span><br>
                <a href="./pass_reset/pass_reset.html" class="blue-link">パスワードを忘れた方はこちら</a>

                <button type="submit" class="login-submit">ログイン</button>
            </form>

            <script>
                function checkInput() {
                    // メールアドレスとパスワードのフィールドの値を取得
                    let mail = document.getElementById('mail').value;
                    let passwd = document.getElementById('passwd').value;

                    // メールアドレスが入力されていない場合、エラーメッセージを表示
                    if (mail === "") {
                        document.getElementById('mailError').style.display = 'inline';
                    } else {
                        document.getElementById('mailError').style.display = 'none';
                    }

                    // パスワードが入力されていない場合、エラーメッセージを表示
                    if (passwd === "") {
                        document.getElementById('passwdError').style.display = 'inline';
                    } else {
                        document.getElementById('passwdError').style.display = 'none';
                    }
                }
            </script>
            
            <p>アカウントをお持ちでない方は<a href="./registartion/registration.php" class="blue-link">こちら</a></p>
        </div>
    </main>

</body>
</html>