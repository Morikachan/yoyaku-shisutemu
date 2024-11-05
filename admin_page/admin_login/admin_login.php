<?php
session_start();
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

$sql = "SELECT appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN user_info ON appointment.id = user_info.id;";
// $sql = "SELECT * FROM user_info join appointment";

try {
    $stmt = $pdo->query($sql);
    //fetchAllでテーブルのデータを取得
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    header("Location: ../user_information/user_information.php");
    exit();
    //echo('<pre>');
    //var_dump($results);
    //echo('</pre');
} catch (PDOException $e) {
    echo '取得失敗';
    exit();
}
?>

<!-- 
SELECT user_info,id,name,katakana,gender,birthday,occupation,school,tel,address,mail,course,day,time,message FROM user_info JOIN appointment;

SELECT user_info.id,name,katakana,gender,birthday,occupation,school,tel,address,mail,course,day,time,message FROM appointment JOIN user_info GROUP BY day;

select appointment.id, name, katakana, gender, birthday, occupation, school, tel, address, mail, course, day, time, message from appointment JOIN user_info ON appointment.id = user_info.id;
-->
