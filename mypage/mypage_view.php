<?php
session_start();
$results = $_SESSION['results'];
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="./mypage.css">
        <title>マイページ</title>
    </head>
    <body>
    <script src="./hamburger.js"></script>
    <header>
            <div class="header-wrap">
                <img src="../img/image 1.png" alt="Arts_Logo">
            </div>
            <!-- ロゴを除くオブジェクトを右に固定するためのdiv -->
            <div class="flex_header">    
                
                  <!-- ハンバーガメニューのリスト -->
                  <ul class="c-header__list c-hamburger-menu__list" id="hamburger-menu_list"><!-- 追記 クラスを追記 -->
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
                  
                  <!-- 新規登録ボタン -->
                  <a href="#" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
        </header>
        <main>
            <p class="locatoin"><a href="">ホームページ</a>へ/マイページ</p>
            <h1>マイページ</h1>
            <div class="content-container">
                <h2>予約情報</h2>
                <div class="Reservation">
                    <?php if($results): ?>
                        <h3>・現在の予約状況</h3>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th class="no">No.</th>
                                    <th class="day">予約日</th>
                                    <th class="time">予約時間</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1;foreach ($results as $row):?>
                                <tr>
                                    <th class="Reservation-day"><?php echo $counter; ?></th>
                                    <th class="Reservation-day"><?php echo $row['day']; ?></th>
                                    <th class="Reservation-day"><?php echo $row['time']; ?>時～</th>
                                </tr>
                            <?php $counter++; endforeach; ?>
                            </tbody>
                        </table>
                        <h3 class="reserve">・予約する</h3>
                        <diV class="Reservation-button">
                            <p><a href="../reservation/reservation.php" class="red-button Registration-button">予約登録</a></p>
                            <p><a href="../cancel_reservation/cancel.php" class="red-button cancel-button">予約キャンセル</a></p>
                        </div>
                    <?php else: ?>
                        <h3>・現在の予約状況</h3>
                        <p class="not-Reservation">予約はありません</p>
                        <h3 class="reserve">・予約する</h3>
                        <p><a href="../reservation/reservation.php" class="red-button not-Reservation-button">予約登録</a></p>
                    <?php endif; ?>  
                </div>
            </div>
        </main>
    </body>
</html>
