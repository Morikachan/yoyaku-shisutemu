<?php
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'reservationsystem_db';

session_start();
function getDBConnection() {
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . ";dbname=" . DB_NAME , DB_USER_NAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e) {
        echo '接続失敗' , $e->getMessage();       
        exit(); 
    }
}
//予約日の表示させるやつ
function checkData($pdo ,$mail , $day){
    $sql = "SELECT DATE_FORMAT(day, '%Y/%m/%d') as day ,time FROM appointment WHERE mail = :mail AND DATE_FORMAT(day, '%Y/%m/%d') < :day";
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':day', $day);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['results'] = $results;
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected > 0;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
//予約日を確認するやつ
function checknumber($pdo , $mail){
    $sql = "SELECT * FROM appointment WHERE mail = :mail";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        //$results = $stmt->fetch(PDO::FETCH_ASSOC);
        //$sth = $pdo -> query($sql);
        $count = $stmt -> rowCount();
        return $count;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
$mail = $_SESSION['mail'];
$day = date("Y/m/d");
$pdo = getDBConnection();
$result = checkData($pdo , $mail , $day);
$result2 = checknumber($pdo , $mail);

if($result2 == 0){
    header('Location: ./participation_history.html');
}
else{
    header('Location: ./participation_history_view.php');
}
exit();
?>
