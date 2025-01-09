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
    $_SESSION['error'] = '接続失敗';
    exit();
}
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

// ここのsqlは変えます
$sql = "SELECT * from user_info where id = 1";

// $sql = "SELECT * from user_info where id = :id";
try {
    // $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    header("Location: ../view/change_Information.php");
    exit();
} catch (PDOException $e) {
    $_SESSION['error'] = 'データベース接続でエラーが発生しました';
    exit();
}
?>