<?php
require_once '../core/Database.php';

session_start();
// $userID = $_SESSION['id'];
$receivedDate = $_POST['data'];
echo 'check';

function selectDateTime($pdo, $receivedDate) {
    $sql = "SELECT time FROM appointment WHERE day = :day";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':day', $receivedDate);
        $stmt->execute();
        $timeArray = $stmt->fetchAll();
        return $timeArray;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

$pdo = Database::getInstance()->getPDO();
// $result = selectDateTime($pdo, $receivedDate['data']);
$result = selectDateTime($pdo, '2024-12-03');
echo $result ? json_encode(['status' => true, 'timeArray' => $result]) : json_encode(['status' => false]);
?>