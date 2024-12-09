<?php
require_once '../core/Database.php';

session_start();

function selectDateTime($pdo, $receivedDate) {
    $sql = "SELECT time FROM appointment WHERE day = :day";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':day', $receivedDate);
        $stmt->execute();
        $time = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $time;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receivedDate = $_POST['date'];
    $pdo = Database::getInstance()->getPDO();
    $result = selectDateTime($pdo, $receivedDate);
    echo json_encode(['status' => true, 'time' => $result]);
}
?>