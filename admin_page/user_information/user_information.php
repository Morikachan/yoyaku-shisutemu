<?php 
session_start();
// 直接このphpファイルパスを指定された場合、ログイン画面に遷移させる
if((!isset($_SESSION['logged']) || $_SESSION['logged'] !== true)){
    header("Location: ../admin_login/admin_login.php");
    exit;
}

require_once '../../core/Database.php';
$db = Database::getInstance();
$pdo = $db -> getPDO();

// 取得件数が0でテストをしたい場合は二つ目のsqlを使用してください
$sql = "SELECT appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN users_info ON appointment.id = users_info.id ORDER BY appointment.id ASC;";
// $sql = "SELECT day from appointment WHERE day = 22/22";

try {
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}


// 予約情報が取得できる場合はエラーメッセージを消す
if (!empty($_SESSION['results'])) {
    $_SESSION['message'] = '';
} else {
    $_SESSION['message'] = '表示する予約情報がありません';
}

$results = $_SESSION['results'];
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="../../login.js"></script>
    <title>管理者ページ</title>
</head>
<body>
    <header class="c-header c-hamburger-menu">

            <!-- アーツカレッジヨコハマのロゴ -->
            <div class="flex_logo">
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../../img/image 1.png" alt="Arts_Logo"></a>
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
                  <a href="#" class="red-button">ログアウト</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
    </header>
    <main>
        <h1>予約情報</h1>

        <!-- 選択ボタン -->
        <button type="button" id="select-button">選択</button>
        <button>変更</button>

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
                <?php if(!empty($_SESSION['message'])):?>
                    <div class="error-message">
                        <?php echo $_SESSION['message']?>
                    </div>
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
                            <div class = "message_scroll">
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