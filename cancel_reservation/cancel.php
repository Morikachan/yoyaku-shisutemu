<?php
session_start();
$results = $_SESSION['results'];
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./cancel.css">
        <title>予約キャンセル</title>
    </head>
    <body>
        <script src="../hamburger.js"></script>
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
            <p class="locatoin"><a href="">ホームページ</a>へ/<a href="../mypage/mypage.php">マイページ</a>へ/予約キャンセル</p>
            <h1>予約キャンセル</h1>
            <div class="content-container">
                <h2>予約情報</h2>
                <div class="Reservation">
                    <h3>・現在の予約状況</h3>
                    <form action="./check_cancel.php" method="post">
                        <table border="1">
                            <tr>
                                <thead>
                                    <th>No.</th>
                                    <th>予約日</th>
                                    <th>予約時間</th>
                                    <th>キャンセル</th>
                                </thead>
                            </tr>
                            <?php $counter = 1;foreach ($results as $row):?>
                                <tr>
                                    <th><?= $counter; ?></th>
                                    <th><?= htmlspecialchars($row['day']); ?></th>
                                    <th><?= htmlspecialchars($row['time']); ?>時～</th>
                                    <th>
                                        <input type="checkbox" name="selected[]" value="<?= $counter; ?>">
                                        <input type="hidden" name="day_<?= $counter; ?>" value="<?= htmlspecialchars($row['day']); ?>">
                                        <input type="hidden" name="time_<?= $counter; ?>" value="<?= htmlspecialchars($row['time']); ?>">
                                    </th>
                                    
                                </tr>
                            <?php $counter++; endforeach; ?>
                        </table>
                        <h3>・本人確認</h3>
                        <div class="check-zone">
                            <p>
                                <h4>・メールアドレス</h4>
                                <input type="email" name="mail" class="check">
                            </P>
                            <p>
                                <h4>・パスワード</h4>
                                <input type="password" name="passwd" class="check">
                            </P>
                        </div>
                        <button type="submit" class="red-button">予約キャンセル</button>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>
