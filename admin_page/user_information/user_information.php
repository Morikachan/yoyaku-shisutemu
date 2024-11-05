<?php
session_start();

$results = $_SESSION['results'];
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>管理者ページ</title>
</head>
<body>
    <header>
        <div class="header-wrap">
            <p><img src="../../img/image 1.png" alt="Arts_Logo"></p>
            <p><a href="#" class="red-button">ログアウト</a></p>
        </div>
    </header>
    <main>
        <h1>予約情報</h1>
            <div class="table_wrap">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>氏名</th>
                        <th>カタカナ</th>
                        <th>性別</th>
                        <th>生年月日</th>
                        <th>職業</th>
                        <th>出身学校</th>
                        <th>電話番号</th>
                        <th>住所</th>
                        <th>メールアドレス</th>
                        <th>希望学科</th>
                        <th>来校日</th>
                        <th>時間</th>
                        <th>備考</th>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>梶浦歩</td>
                        <td>カジウラアユム</td>
                        <td>男</td>
                        <td>2005年05月01日</td>
                        <td>専門学生</td>
                        <td>アーツカレッジヨコハマ</td>
                        <td>000-0000-0000</td>
                        <td>神奈川県海老名市1-1-1-1-1-1</td>
                        <td>k248004@kccollege.ac.jp</td>
                        <td>情報処理学科</td>
                        <td>10/30(水)</td>
                        <td>09:15</td>
                        <td>
                            <div class="table_td">
                                日本国民は、正当に選挙された国会における代表者を通じて行動し、われらとわれらの子孫のために、諸国民との協和による成果と、わが国全土にわたつて自由のもたらす恵沢を確保し、政府の行為によつて再び戦争の惨禍
                            </div>
                        </td>
                    </tr>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['katakana']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['birthday']; ?></td>
                            <td><?php echo $row['occupation']; ?></td>
                            <td><?php echo $row['school']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['mail']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['day']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td>
                                <div>
                                    <?php echo $row['message']; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
    </main>
</body>
</html>