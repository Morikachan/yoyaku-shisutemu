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

$sql = "SELECT appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN user_info ON appointment.id = user_info.id;";
// $sql = "SELECT * from test";
try {
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    $_SESSION['message'] ;
    if(empty($results)){
        $_SESSION['message'] = '予約情報を取得できませんでした';
    }
    var_dump($results);
    header("Location: ../user_information/user_information.php");
    exit();
} catch (PDOException $e) {
    echo '取得失敗';
    exit();
}
?>