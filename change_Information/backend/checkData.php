<?php
// 送信されたデータをループで一覧表示
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>送信されたデータ:</h2>";
    echo "<ul>";
    foreach ($_POST as $key => $value) {
        echo "<li>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "</li>";
    }
    echo "</ul>";
} else {
    echo "フォームからデータが送信されていません。";
}


// データの連結
$name = $_POST['lastName']."　".$_POST['firstName'];//漢字
$kana = $_POST['lastKana']."　".$_POST['firstKana'];//カタカナ

// // -----------------------------------------------------------------------------------------------------------------------
// // -----------------------------------------------------------------------------------------------------------------------
// // -----------------------------------------------------------------------------------------------------------------------


// // require_once '../../core/Database.php';

// //ーーーーーーーーーーーーーーーーーーーーここから下は消す予定ーーーーーーーーーーーーーーーーーーーー
// const DB_SERVER_NAME = 'localhost';
// const DB_USER_NAME = 'root';
// const DB_PASSWORD = '';
// const DB_NAME = 'test';
// try {
//     $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo '接続失敗';
//     exit();
// }
// //ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
// try {
//     // $sql = "UPDATE user_info SET name = :name, katakana = :katakana, tel = :tel WHERE id = :id";
//     $sql = "UPDATE user_info SET name = :name, katakana = :katakana, tel = :tel WHERE id = 1";
//     $stmt = $pdo->prepare($sql);
  
//     // 値を入れる！
//     $stmt->bindParam(':name', $name, PDO::PARAM_STR);
//     $stmt->bindParam(':katakana', $kana, PDO::PARAM_STR);
  
//     $stmt->execute();
  
//     echo "ユーザー情報が正常に更新されました。";
  
// } catch (PDOException $e) {
//     echo "エラー: " . $e->getMessage();
// }







?>