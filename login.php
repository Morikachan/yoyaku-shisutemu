<?php
session_start();
require_once './core/Database.php';

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
    $sql = "SELECT * FROM users_info WHERE mail = :mail";
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
    $pdo = Database::getInstance()->getPDO();
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];
    $user = selectUserData($pdo,$mail);
    if (!$user) {
        $_SESSION['error'] = '入力されたメールアドレスが見つかりませんでした。</br>もう一度やり直してください。';
        header("Location: ./login.php");
        exit;
    } else if ($user && password_verify($passwd,$user['passwd'])) {
        $_SESSION['id'] = $user['id'];
        header("Location: ./mypage/mypage.php");
    } else {
        $_SESSION['error'] = 'パスワードが違います。</br>もう一度やり直してください。';
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
    <script src="./hamburger.js" defer></script>
    <script src="./scrollTop.js" defer></script>
    <script src="https://kit.fontawesome.com/f640a591db.js" crossorigin="anonymous"></script>
    <title>ログイン</title>
</head>
<body>
    <header class="c-header c-hamburger-menu">
            <!-- アーツカレッジヨコハマのロゴ -->
            <div class="flex_logo">
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="img/image 1.png" alt="Arts_Logo"></a>
            </div>

            <!-- ロゴを除くオブジェクトを右に固定するためのdiv -->
            <div class="flex_header">    
                
                  <!-- ハンバーガメニューのリスト -->
                  <ul class="c-header__list c-hamburger-menu__list" id="hamburger-menu_list"><!-- 追記 クラスを追記 -->
                      <li class="c-header__list-item">
                        <a href="https://www.kccollege.ac.jp/" class="c-header__list-link">ホームページへ</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./login.php" class="c-header__list-link">ログイン</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./inquiry/inquiry.php" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="./registration/registration.php" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
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
                <label for="mail"><h3>メールアドレス</h3></label>
                <input type="email" id="mail" name="mail"><br>
                <span class="inputErrorMess" id="mailError">メールアドレスを入力してください。</span><br>

                <label for="passwd"><h3>パスワード</h3></label>
                <input type="password" id="passwd" name="passwd"><br>
                <span class="inputErrorMess" id="passwdError">パスワードを入力してください。</span><br>
                <a href="./pass_reset/pass_reset.html" class="blue-link">パスワードを忘れた方はこちら</a>

                <button type="submit" class="login-submit">ログイン</button>
            </form>

            <script>
                // メールとパスワードのフィールドの値を取得
                const mail = document.getElementById('mail');
                const passwd = document.getElementById('passwd');

                mail.addEventListener('focusout', () => {
                    // 管理者IDが入力されていない場合、エラーメッセージを表示
                    if (mail.value === "") {
                        console.log(mail.value);
                        document.getElementById('mailError').style.display = 'inline-block';
                        document.getElementById('mail').style.backgroundColor = '#FF8989';
                    } else {
                        document.getElementById('mailError').style.display = 'none';
                        document.getElementById('mail').style.backgroundColor = '#FFFFFF';
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
            
            <p>アカウントをお持ちでない方は<a href="./registration/registration.php" class="blue-link">こちら</a></p>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <!-- CONTACT INFO + SNS -->
                <h3>お問い合わせの情報</h3>
                <div>
                    <p>アーツカレッジヨコハマ</p>
                    <p>〒220-0072</p>
                    <p>神奈川県横浜市西区浅間町2-105-8</p>
                    <p> TEL：
                        <a href="tel:0120-557-754">0120-557-754</a>
                        （平日9〜17時）
                    </p>
                    <p>MAIL：
                        <a href="mailto:master@kccollege.ac.jp">master@kccollege.ac.jp</a>
                    </p>
                    <a href="#">お問い合わせフォームへ</a>
                    <div class="icons">
                        <a href="https://twitter.com/artscollege" class="twitter"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/artscollegeofficial/" class="insta"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://lin.ee/tqexEQX" class="line"><i class="fa-brands fa-line"></i></a>
                        <a href="https://www.youtube.com/channel/UCADAYqNIxMTkg2OE8_5aNzA/" class="youtube"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://ja-jp.facebook.com/artscollegeyokohama" id="facebook"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-section">
                <!-- ACCESS -->
                <h3>アクセス</h3>
                <div>
                    <p>横浜駅西口より徒歩15分 相鉄線平沼橋駅より徒歩11分</p>
                    <p>横浜駅西口ターミナルからバス25、202系統</p>
                    <p>「浅岡橋」バス停下車徒歩2分</p>  
                </div>
            </div>
            <div class="footer-section">
                <!-- MAP -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6499.293489360595!2d139.609711!3d35.463539!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60185c09e09a76a5%3A0xd9f33045278944be!2z44Ki44O844OE44Kr44Os44OD44K444Oo44Kz44OP44Oe!5e0!3m2!1sja!2sjp!4v1736212708651!5m2!1sja!2sjp" width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <small>Copyright　&copy;システム開発Cチーム　2025</small>
    </footer>
    <a id="page-top">TOP</a>
</body>
</html>