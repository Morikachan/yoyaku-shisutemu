<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./registration_style.css">
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <script src="./input-check.js" defer></script>
    <script src="../hamburger.js" defer></script>
    <script src="../scrollTop.js" defer></script>
    <script src="https://kit.fontawesome.com/f640a591db.js" crossorigin="anonymous"></script>
    <title>新規登録</title>
</head>
<body id="body">
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
                        <a href="../inquiry/inquiry.php" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="../registration/registration.php" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
        
    </header>
    <main id="main">
        <p class="location"><a href="https://www.kccollege.ac.jp/">ホームページ</a> / <a href="../login.php">ログイン</a> / 新規登録</p>
        <h1>新規登録</h1>
            <div class="content-container">
                <?php if(isset($_SESSION['error'])):?>
                    <div class="error-message">
                        <p>
                            <?php echo $_SESSION['error'] ?>
                        </p>
                    </div>
                    <?php unset($_SESSION['error']);?>
                <?php endif;?>
                <form action="registration-check.php" method="post" class="h-adr">
                    <h2>ログイン情報</h2>
                        <span class="required">必須</span>
                        <label for="email"><h3>メールアドレス</h3></label>
                            <input type="email" name="mail" id="mail" placeholder="例）example@mail.com">
                            <span id="mailError" class="errorMessage"></span><br>

                        <span class="required">必須</span>
                        <label for="password"><h3>パスワード</h3></label>
                            <input type="password" name="password" id="password">
                            <span id="passwordError" class="errorMessage"></span><br>

                        <span class="required">必須</span>
                        <label for="password_check"><h3>パスワード確認</h3></label>
                            <input type="password" name="password_check" id="passwordCheck">
                            <span id="passwordCheckError" class="errorMessage"></span><br>

                    <h2>個人情報</h2>
                        <span class="required">必須</span><h3>氏名</h3>
                            <div>
                                <div class="name-container">
                                    <input type="text" name="lastName" id="lastName" placeholder="例）山田" value="">
                                    <input type="text" name="firstName" id="firstName" placeholder="例）太郎" value="">
                                </div>
                                <span id="nameError" class="errorMessage" style="margin-bottom: 10px"></span>
                                <div class="name-container">
                                    <input type="text" name="lastNameKana" id="lastNameKana" placeholder="例）ヤマダ" value="">
                                    <input type="text" name="firstNameKana" id="firstNameKana" placeholder="例）タロウ" value="">
                                </div>
                                <span id="nameKanaError" class="errorMessage"></span>
                            </div>
                        <div>
                            <span class="required">必須</span><h3>性別</h3>
                            <div class="gender-container">
                                <label><p><input type="radio" name="gender" value="男性" id="1">男性</p></label>
                                <label><p><input type="radio" name="gender" value="女性" id="2">女性</p></label>
                                <label><p><input type="radio" name="gender" value="その他" id="3">その他</p></label>
                            </div>
                            <span id="genderError" class="errorMessage"></span>
                        </div>
                        <span class="required">必須</span><h3>生年月日</h3>
                            <input type="date" name="date" id="date">
                            <span id="dateError" class="errorMessage"></span><br>
                        <span class="required">必須</span><h3>希望学科</h3>
                            <select name="course" id="course">
                                <option value="">選択してください</option>
                                <option value="game">ゲームクリエイター学科</option>
                                <option value="design">デザイン学科</option>
                                <option value="cs">情報処理学科</option>
                            </select>
                            <span id="courseError" class="errorMessage"></span><br>
                        <span class="required">必須</span><h3>職業</h3>
                            <select name="occupation" id="occupation">
                                <option value="">選択してください</option>
                                <option value="highschool1">高校1年生</option>
                                <option value="highschool2">高校2年生</option>
                                <option value="highschool3">高校3年生</option>
                                <option value="highschool3">高校4年生</option>
                                <option value="prepSchoolStudent">予備校生</option>
                                <option value="gradStudent">大学院生</option>
                                <option value="university">大学生</option>
                                <option value="juniorCollege">短大生</option>
                                <option value="collegeStudent">高専生</option>
                                <option value="vocationalSchool">専門学校生</option>
                                <option value="juniorHighSchoolStudent">中学生</option>
                                <option value="elementarySchoolStudent">小学生</option>
                                <option value="otherStudent">その他の学生</option>
                                <option value="adult">社会人</option>
                                <option value="internationalStudent">留学生</option>
                                <option value="parents">保護者</option>
                                <option value="teacher">先生</option>
                                <option value="highSchoolGraduation">高卒認定</option>
                                <option value="different">その他</option>
                            </select>
                        <span id="occupationError" class="errorMessage"></span><br>
                        
                        <span class="required">必須</span>
                        <label for="school"><h3>出身学校</h3></label>
                            <input type="text" name="school" id="school" placeholder="例）〇〇〇高等学校">
                            <span id="schoolError" class="errorMessage"></span><br>

                        <span class="required">必須</span>
                        <label for="tel"><h3>電話番号</h3></label>
                            <input type="tel" name="tel" id="tel" placeholder="例）080123456789" required>
                            <span id="telError" class="errorMessage"></span><br>
                            
                            <span class="required">必須</span><h3>住所</h3>
                            <span class="p-country-name" style="display:none;">Japan</span>
                                <input type="text" class="p-postal-code" size="8" maxlength="8" id="postalcode" placeholder="〒" name="postalcode">
                            <div class="address">
                                <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address1" id="address1">
                                <input type="text" class="" name="address2" id="address2">
                            </div>
                            <span id="addressError" class="errorMessage" style="margin-bottom: 10px"></span><br>
                            <p id="info-confirm">
                                <input type="checkbox" name="approved" id="approved">
                                個人情報の保護に同意します。<br/>
                            </p>
                        <button type="submit" class="login-submit" disabled>新規登録の情報を入力してください</button>
                </form>
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
                    <a href="../inquiry/inquiry.php">お問い合わせフォームへ</a>
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