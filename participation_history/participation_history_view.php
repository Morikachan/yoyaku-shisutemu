<?php
session_start();
$results_participation_history = $_SESSION['results_participation_history'];
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="./reservation_history.css">
        <script src="./hamburger.js" defer></script>
        <script src="./scrollTop.js" defer></script>
        <script src="https://kit.fontawesome.com/f640a591db.js" crossorigin="anonymous"></script>
        <title>参加履歴</title>
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
                        <a href="./participation_history/participation_history.php" class="c-header__list-link">参加履歴</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../change_Information/view/change_Information.php" class="c-header__list-link">登録内容の変更</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../delete_account/html/delete.html" class="c-header__list-link">アカウント削除</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../inquiry/inquiry.html" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="./registration/registration.php" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
    </header>

    
        <main>
            <p class="locatoin"><a href="">ホームページ</a>へ/<a href="../mypage/mypage.php">マイページ</a>へ/参加履歴</p>
            <h1>参加履歴</h1>
            <div class="content-container">
                <?php if($results_participation_history): ?>
                    <h2>参加情報</h2>
                    <div class="participation">
                        <h3>・参加履歴</h3>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th class="No">NO.</th>
                                    <th class="day">参加日</th>
                                    <th class="time">参加日時</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1;foreach ($results_participation_history as $row):?>
                                <tr>
                                    <th class="table-size"><?php echo $counter; ?></th>
                                    <th class="table-size"><?php echo $row['day']; ?></th>
                                    <th class="table-size"><?php echo $row['time']; ?>時～</th>
                                </tr>
                            <?php $counter++; endforeach; ?>
                            </tbody>
                        </table>
                        <p class="mypage-move"><a href="../mypage/mypage.php" class="participation_history-button">マイページ</a></p>
                    </div>
                <?php else: ?>
                    <h2>参加情報</h2>
                    <div class="participation">
                        <h3>参加履歴</h3>
                        <p class="none-participation">・現在参加履歴はありません</p>
                        <p class="mypage-move"><a href="../mypage/mypage.php" class="participation_history-button move-button">マイページ</a></p>
                    </div>
                <?php endif; ?>        
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
