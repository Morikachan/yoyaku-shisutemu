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
function checkData($pdo ,$id , $day){
    $sql = "SELECT DATE_FORMAT(day, '%Y/%m/%d') as day ,time FROM appointment WHERE id = :id AND DATE_FORMAT(day, '%Y/%m/%d') < :day;";
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':day', $day);
        $stmt->execute();
        $results_participation_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['results_participation_history'] = $results_participation_history;
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected > 0;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
//予約日を確認するやつ
function checknumber($pdo , $id , $day){
    $sql = "SELECT * FROM appointment WHERE id = :id AND DATE_FORMAT(day, '%Y/%m/%d') < :day AND display = ''";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':day', $day);
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
$id = $_SESSION['id'];
$day = date("Y/m/d");
$pdo = getDBConnection();
$result = checkData($pdo , $id , $day);
$result2 = checknumber($pdo , $id , $day);

$delte = $_SESSION['delte'];
if($delte = 1){
    $delte = $_SESSION['delte'];
}
else{
    $delte = 0;
    $_SESSION['delte'] = $delte;
}

header('Location: ./participation_history_view.php');

?>
