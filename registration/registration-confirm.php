<?php 
    session_start();
    if(empty($_SESSION['UserRegistrationInfo'])){
        header("Location: ./registration.php");
    }
    $UserRegistrationInfo = $_SESSION['UserRegistrationInfo'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./registration_style.css">
    <script src="../hamburger.js" defer></script>
    <script src="../scrollTop.js" defer></script>
    <script src="https://kit.fontawesome.com/f640a591db.js" crossorigin="anonymous"></script>
    <title>新規登録確認</title>
</head>
<body>
    <header class="c-header c-hamburger-menu">

            <!-- アーツカレッジヨコハマのロゴ -->
            <div class="flex_logo">
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../img/image 1.png" alt="Arts_Logo"></a>
            </div>

            <!-- ロゴを除くオブジェクトを右に固定するためのdiv -->
            <div class="flex_header">    
                
                  <!-- ハンバーガメニューのリスト -->
                  <ul class="c-header__list c-hamburger-menu__list" id="hamburger-menu_list"><!-- 追記 クラスを追記 -->
                      <li class="c-header__list-item">
                        <a href="https://www.kccollege.ac.jp/" class="c-header__list-link">ホームページへ</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../login.php" class="c-header__list-link">ログイン</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../inquiry/inquiry.html" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  <!-- 新規登録ボタン -->
                  <a href="../registration/registration.php" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
    </header>
            <main>
                <p class="location"><a href="https://www.kccollege.ac.jp/">ホームページ</a> / <a href="../login.php">ログイン</a> / <a href="./registration.php">新規登録</a> / 新規登録確認</p>
                <h1 id="h1">新規登録確認</h1>
                <div class="content-container">
                    <?php if(isset($_SESSION['error'])):?>
                        <div class="error-message">
                            <?php echo $_SESSION['error'] ?>
                        </div>
                        <?php unset($_SESSION['error']);?>
                        <?php endif;?>
                    <h2>ログイン情報</h2>
                        <span class="required">必須</span><h3>メールアドレス</h3>
                            <input type="text" name="mail" id="mail" value=<?php echo $UserRegistrationInfo['mail'] ?> readonly>  
                    <h2>個人情報</h2>
                        <span class="required">必須</span><h3>氏名</h3>
                        <div>
                            <h4>姓・名</h4>
                            <div class="name-container">
                                <input type="text" name="lastName" id="lastName" value=<?php echo $UserRegistrationInfo['lastName'] ?> readonly>
                                <input type="text" name="firstName" id="firstName" value=<?php echo $UserRegistrationInfo['firstName'] ?> readonly>
                            </div>
                            <h4>姓・名（フリガナ）</h4>
                            <div class="name-container">
                                <input type="text" name="lastNameKana" id="lastNameKana" value=<?php echo $UserRegistrationInfo['lastNameKana'] ?> readonly>
                                <input type="text" name="firstNameKana" id="firstNameKana" value=<?php echo $UserRegistrationInfo['firstNameKana'] ?> readonly>
                            </div>
                        </div>
                        <span class="required">必須</span><h3>性別</h3>
                            <input type="text" name="gender" id="gender" value=<?php echo $UserRegistrationInfo['gender'] ?> readonly>
                        <span class="required">必須</span><h3>生年月日</h3>
                            <input type="date" name="date" id="date" value=<?php echo $UserRegistrationInfo['birthday'] ?> readonly>
                        <span class="required">必須</span><h3>希望学科</h3>
                            <!-- <input type="text" name="course" id="course" value=<?php echo $UserRegistrationInfo['course'] ?> required readonly> -->
                            <select name="course" id="course">
                                <option value="course"><?php echo $UserRegistrationInfo['course'] ?></option>
                            </select>
                        <span class="required">必須</span><h3>職業</h3>
                            <select name="occupation" id="occupation">
                                <option value="occupation"><?php echo $UserRegistrationInfo['occupation']?></option>
                            </select>
                        <label for="school"><h3>出身学校</h3></label>
                            <input type="text" name="school" id="school" value=<?php echo $UserRegistrationInfo['school'] ?> readonly>
                        <span class="required">必須</span><h3>電話番号</h3>
                            <input type="tel" name="tel" id="tel" value=<?php echo $UserRegistrationInfo['tel'] ?> readonly>
                        <span class="required">必須</span><h3>住所</h3>
                            <input type="text" name="zipcode" id="zipcode" value=<?php echo $UserRegistrationInfo['zipcode'] ?> readonly>
                            <div class="address">
                                <input type="text" name="address1" id="address1" value=<?php echo $UserRegistrationInfo['address1'] ?> readonly>
                                <input type="text" name="address2" id="address2" value=<?php echo $UserRegistrationInfo['address2'] ?> readonly>
                            </div>
                            <div class="registration-confirm-buttons">
                                <button type="button" class="login-submit" onclick="history.back()">戻る</button>
                                <button type="button" method="post" class="login-submit" id="modalBtn">登録</button>
                            </div>
                            <div id="modal" class="modal">
                                <div class="modal-content">
                                    <h4>登録完了</h4>
                                    <p>登録できました</p>
                                    <p>ログインしてください</p>
                                    <a class="return-btn" href="../login.php">ログインへ</a>
                            </div>
                        </div>
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
             
            <script src="./modal-window.js" defer></script>
</body>
</html>