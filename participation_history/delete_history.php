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
    //参加日消すやつ
    function checkData($pdo , $day){
        $sql = "DELETE FROM appointment WHERE DATE_FORMAT(day, '%Y/%m/%d') <= :day";
        try{
            $stmt = $pdo->prepare($sql);
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

    $day = date("Y/m/d");
    $pdo = getDBConnection();
    $result = checkData($pdo , $day);

    header('Location: ./participation_history.php');

?>
