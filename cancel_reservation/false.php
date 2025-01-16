<?php
session_start();
$results_mypage = $_SESSION['results_mypage'];
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
        </header>        <main>
            <p class="locatoin"><a href="">ホームページ</a>へ/<a href="../mypage/mypage.php">マイページ</a>へ/予約キャンセル</p>
            <h1>予約キャンセル</h1>
            <div class="content-container">
                <?php if($results_mypage): ?>
                    <div class="error">
                        <p>・メールアドレスまたはパスワードが間違っています。</p>
                        <p>　もう一度やり直してください。</p>
                    </div>
                <?php endif; ?>
                <h2>予約情報</h2>
                <div class="Reservation">
                    <?php if($results_mypage): ?>
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
                                <?php $counter = 1;foreach ($results_mypage as $row):?>
                                    <tr>
                                    <th class="no"><?= $counter; ?></th>
                                        <th class="day"><?= htmlspecialchars($row['day']); ?></th>
                                        <th class="time"><?= htmlspecialchars($row['time']); ?>時～</th>
                                        <th  class="cancel">
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
                                <h3>メールアドレス:</h3>
                                <input type="email" name="mail" id="name" class="check error-input">
                                </p>
                                <p class="error-font">※メールアドレスを入力してください</p>
                                <p>
                                <h3>パスワード:</h3>
                                <input type="password" name="passwd" id="passwd" class="check error-input">
                                </p>
                                <p class="error-font">※パスワードを入力してください</p>
                            </div>
                            <button type="submit" class="red-button cancel-button">予約キャンセル</button>
                            <p><a href="../mypage/mypage.php" class="red-button mypage-move">マイページ</a></p>
                        </form>
                    <?php else: ?>
                        <h3>・現在の予約状況</h3>
                        <P class="not-cancel">現在予約はありません</p>
                        <P><a href="../mypage/mypage.php" class="red-button">マイページ</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </body>
</html>
