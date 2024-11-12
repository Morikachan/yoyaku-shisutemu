<?php
session_start();
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'test';


// ここから下記のコメントアウトを削除すると入力されたデータを表示できます 
            /* ---------- 記入内容 ---------
                    meil   = aaa@aaa        
                    passwd = test
            ---------------------------- */
// login.htmlから値を貰う
// $mail = $_POST['mail'];
// $passwd = $_POST['passwd'];
//テストで入力したパスワードをハッシュ化

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
    $passHash = password_hash($passwd, PASSWORD_DEFAULT);
    $user = selectUserData($pdo,$mail);
    
        // echo "入力されたメールアドレス";
        // echo "</br>";
        // echo $mail;
        // echo "</br>";
        // echo "</br>";
        // echo "入力されたパスワードは";
        // echo "</br>";
        // echo $passwd;
        // echo "</br>";
        // echo "</br>";
        // echo "ハッシュ化されたパスワードは";
        // echo "</br>";
        // echo $passHash;
        // echo "</br>";
        // echo "</br>";
    if (!$user) {
        $_SESSION['error'] = '入力されたメールアドレスが見つかりませんでした';
        header("Location: ./login.php");
        exit;
    } else if ($user && password_verify($passwd,$user['passwd'])) {
        header("refresh:3;./mypage/mypage.html");
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
            <div class="content-container">
                <?php if(isset($_SESSION['error'])) :?>
                        <div class="error-message">
                            <?php echo $_SESSION['error']?>
                        </div>
                    <?php 
                    unset($_SESSION['error']);?>
                <?php endif;?>
                <form action="./login.php" method="post">
                    <h3>メールアドレス</h3>
                    <input type="email" name="mail" id="mail">
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