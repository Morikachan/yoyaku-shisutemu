<?php
session_start();

// require_once '../../core/Database.php';

//ーーーーーーーーーーーーーーーーーーーーここから下は消す予定ーーーーーーーーーーーーーーーーーーーー
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'test';
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続失敗';
    exit();
}
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$sql = "SELECT appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN user_info ON appointment.id = user_info.id ORDER BY appointment.id ASC;";
// $sql = "SELECT * from test";/*-- 取得件数を0件でテストしたい場合使用 --*/

try {
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    if(empty($results)){
        $_SESSION['message'] = '表示する予約情報がありません';
    }
    header("Location: ../user_information/user_information.php");
    exit();
} catch (PDOException $e) {
    echo 'データベース接続でエラーが発生しました';
    exit();
}
?>