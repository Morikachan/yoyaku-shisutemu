<?php
session_start();
$results = $_SESSION['results'];
// require_once '../../core/Database.php';
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーここから下は消す予定ーーーーーーーーーーーーーーーーーーーーーーーーーーーー
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'test';
function getDbConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . 
        ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    }
}
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
function getUserData($pdo) {
    $sql = "SELECT appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN user_info ON appointment.id = user_info.id;";
    try {
        $stmt = $pdo->query($sql);
        //fetchAllでテーブルのデータを取得
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['results'] = $results;
        exit();
        //echo('<pre>');
        //var_dump($results);
        //echo('</pre');
    } catch (PDOException $e) {
        echo '取得失敗';
        exit();
    }
}
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
    <header class="c-header c-hamburger-menu"><!-- 追記 クラスを追記 -->
        <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../../img/image 1.png" alt="Arts_Logo"></a>
        <div class="flex">
            <a href="#" class="red-button">ログアウト</a>
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
                    <?php if(isset($_SESSION['message'])) :?>
                    <div class="error-message">
                        <?php echo $_SESSION['message']?>
                    </div>
                    <?php 
                        unset($_SESSION['message']);?>
                    <?php endif;?>
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