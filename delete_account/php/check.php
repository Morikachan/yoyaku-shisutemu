<?php
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'reservationsystem_db';

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

function checkData($pdo ,$mail , $passwd){
    echo $mail;
    echo $passwd;
        $sql = "SELECT * FROM users_info WHERE mail = :mail and passwd = :passwd";
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':passwd', $passwd);
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            return $rowsAffected > 0;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    $pdo = getDBConnection();
    session_start();
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];

    $_SESSION['mail'] = $mail;
    $_SESSION['passwd'] = $passwd;

    $result  = checkData($pdo ,  $mail , $passwd);
    if($result){
        header('Location: ../html/check.html');
    }
    else{
        header('Location: ../html/faluse.html');
    }
?>