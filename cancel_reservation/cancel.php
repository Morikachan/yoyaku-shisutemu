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
        <header>
            <div class="header-wrap">
                <img src="../img/image 1.png" alt="Arts_Logo">
            </div>
            <div class="header-wrap">
                
                <!-- ハンバーガーメニュー部分 -->
                
                <!--ここまででハンバーガメニュー終わり-->
            </div>
        </header>
        <main>
            <p class="locatoin"><a href="">ホームページ</a>へ/<a href="../mypage/mypage.php">マイページ</a>へ/予約キャンセル</p>
            <h1>予約キャンセル</h1>
            <div class="content-container">
                <h2>予約情報</h2>
                <div class="Reservation">
                    <?php if($results): ?>
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
