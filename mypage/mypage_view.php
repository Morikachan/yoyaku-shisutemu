<?php
session_start();
$results = $_SESSION['results'];
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./mypage.css">
        <title>マイページ</title>
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
            <p class="locatoin"><a href="">ホームページ</a>へ/マイページ</p>
            <h1>マイページ</h1>
            <div class="content-container">
                <h2>予約情報</h2>
                <div class="Reservation">
                    <div class="title">
                        <h3>・現在の予約状況</h3>
                        <a href="./mypage.php" class="red-button">情報を更新する</a>
                    </div>
                    <table border="1">
                        <tr>
                            <thead>
                                <th>No.</th>
                                <th>予約日</th>
                                <th>予約時間</th>
                            </thead>
                        </tr>
                        <?php $counter = 1;foreach ($results as $row):?>
                            <tr>
                                <th><?php echo $counter; ?></th>
                                <th><?php echo $row['day']; ?></th>
                                <th><?php echo $row['time']; ?>～</th>
                            </tr>
                        <?php $counter++; endforeach; ?>
                    </table>
                    <h3 class="reserve">・予約する</h3>
                    <diV class="Reservation-button">
                        <p><a href="" class="red-button">予約登録</a></p>
                        <p><a href="" class="red-button">予約キャンセル</a></p>
                    </div>
                </div>
                <div class="accsess">
                    <h2>アクセス情報</h2>
                    <h3>アクセス方法</h3>
                    <p class="time">・徒歩：横浜駅から約20分</p>
                    <p class="time">・バス：浅岡橋で降りてから徒歩約3分</p>
                    <div class="infomation">
                        <p class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6499.293489360594!2d139.609711!3d35.463539000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60185c09e09a76a5%3A0xd9f33045278944be!2z44Ki44O844OE44Kr44Os44OD44K444Oo44Kz44OP44Oe!5e0!3m2!1sja!2sjp!4v1731385159979!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </p>
                        <h3>アドレス</h3>
                        <p>・郵便番号：〒220-0072</p>
                        <p>・所在地　：神奈川県横浜市 西区浅間町2-105-8</p>
                        <p>・電話番号：045-324-0011</p>
                        <p>・営業時間：9:00～17:00</p>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>