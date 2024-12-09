<?php
require_once '../core/Database.php';

session_start();
$userID = $_SESSION['id'];

function insertReservationData($pdo, $id, $day, $time, $message){
    $sql = "INSERT INTO appointment (id, day, time, message) VALUES (:id, :day, :time, :message)";
    try{
        $smtp = $pdo->prepare($sql);
        $smtp->bindParam(':id', $id);
        $smtp->bindParam(':day', $day);
        $smtp->bindParam(':time', $time);
        $smtp->bindParam(':message', $message);
        return $smtp->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userDate = $_POST['date'];
    $userTime = $_POST['time'];
    $userMessage = $_POST['message'];
    $pdo = Database::getInstance()->getPDO();
    $result = insertReservationData($pdo, $userID, $userDate, $userTime, $userMessage);
    echo $result ? json_encode(['status' => true]) : json_encode(['status' => false]) ;
}
?>