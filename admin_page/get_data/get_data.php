<?php
if((!isset($_SESSION['logged']) || $_SESSION['logged'] !== true)){
    header("Location: ../admin_login/admin_login.php");
    exit;
}
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'test';
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit();
}

// 取得件数が0でテストをしたい場合は二つ目のsqlを使用してください
$sql = "SELECT appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN user_info ON appointment.id = user_info.id ORDER BY appointment.id ASC;";
// $sql = "SELECT * from test";

try {
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    if(!isset($result)){
        $_SESSION['message'] = '表示する予約情報がありません';
    }
    // if(empty($results)){
    //     $_SESSION['message'] = '表示する予約情報がありません';
    // }
} catch (PDOException $e) {
    exit();
}
?>