<?php
    session_start();
    if(empty($_SESSION['id'])){
        header("Location: ../login.php");
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="./calendarScript.js" defer></script>
    <script src="../hamburger.js" defer></script>
    <script src="../scrollTop.js" defer></script>
    <script src="https://kit.fontawesome.com/f640a591db.js" crossorigin="anonymous"></script>
    <title>予約</title>
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
                        <a href="../mypage/mypage.html" class="c-header__list-link">マイページ</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../participation_history/participation_history.php" class="c-header__list-link">参加履歴</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../change_Information/view/change_Information.php" class="c-header__list-link">登録内容の変更</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../delete_account/html/delete.html" class="c-header__list-link">アカウント削除</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="../inquiry/inquiry.php" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="../logout.php" class="red-button">ログアウト</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
    </header>
    <main>
        <p class="location"><a href="https://www.kccollege.ac.jp/">ホームページ</a> / <a href="../mypage/mypage.html">マイページ</a> / 予約ページ</p>
        <h1>予約ページ</h1>
        <div class="content-container">
            <div class="calendar-container">
                <span class="required">必須</span><h3>日付</h3>
                <div class="calendar">
                    <div class="header">
                        <!-- 先月 -->
                        <button class="btn prev">
                            <i>≪</i>
                        </button>
                        <!-- 今月 -->
                        <div class="month">11月 2024年</div>
                        <!-- 来月 -->
                        <button class="btn next">
                            <i>≫</i>
                        </button>
                    </div>
                    <div class="weekdays">
                        <div class="day">日</div>
                        <div class="day">月</div>
                        <div class="day">火</div>
                        <div class="day">水</div>
                        <div class="day">木</div>
                        <div class="day">金</div>
                        <div class="day">土</div>
                    </div>
                    <div class="days">
                        <!-- jsでの処理 -->
                    </div>
                </div>
            </div>

            <div class="day-info">
                <span class="required">必須</span><h3>時間</h3>
                <div>
                    <ul class="timetable">
                        <!-- jsとphpでの処理 -->
                    </ul>
                </div>

                <h3>備考</h3>
                <textarea name="message" id="message" style="display: block"></textarea>
                <p>
                    <button type="button" id="sendReserv-btn" disabled>予約する</button>
                </p>
            </div>
        </div>
        <div id="modal" class="modal">
            <div class="modal-content">
                <h4>予約完了</h4>
                <p>予約できました</p>
                <a class="return-btn" href="../mypage/mypage.php">マイページへ戻る</a>
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
</body>
</html>