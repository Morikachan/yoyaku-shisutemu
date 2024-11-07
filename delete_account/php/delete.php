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

function deletData($pdo , $mail , $passwd){
    $sql = "DELETE FROM users_info WHERE mail = :mail and passwd = :passwd";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail' , $mail);
        $stmt->bindParam(':passwd' , $passwd);
        //
        $stmt->execute();
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected > 0;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
function deletappoint($pdo , $mail){
    $sql = "DELETE FROM appointment WHERE mail = :mail";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail' , $mail);
        //
        $stmt->execute();
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected > 0;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

session_start();
$mail = $_SESSION['mail'];
$passwd = $_SESSION['passwd'];

$pdo = getDBConnection();

$result = deletData($pdo , $mail , $passwd);
if($result){
    $pdo = getDBConnection();
    $mail = $_SESSION['mail'];
    $result = deletappoint($pdo , $mail);
    if($result){<?php
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

function deletData($pdo , $mail , $passwd){
    
    $sql = 'DELETE FROM users_info WHERE mail = :mail';

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail' , $mail);
        //
        return $stmt->execute(); 
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}
function deletappoint($pdo , $mail){
    $sql = "DELETE FROM appointment WHERE mail = :mail";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail' , $mail);
        //
        $stmt->execute();
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected > 0;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

session_start();
$pdo = getDBConnection();
$mail = $_SESSION['mail'];
$passwd = $_SESSION['passwd'];
$hashPassword = password_hash($passwd, PASSWORD_DEFAULT);
$result = deletData($pdo , $mail , $hashPassword);
if($result){
    $pdo = getDBConnection();
    $mail = $_SESSION['mail'];
    $result = deletappoint($pdo , $mail);
    if($result){
        header('Location: ../html/success.html');
    }
    else{
      header('Location: ../html/else.html');
    }
}
else{
    header('Location: ../html/else.html');
}
?>
        header('Location: ../html/success.html');
    }
    else{
      header('Location: ../html/else.html');
    }
}
else{
    header('Location: ../html/else.html');
}
?>
