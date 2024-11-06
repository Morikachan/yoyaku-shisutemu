<?php
require_once '../core/Database.php';
function searchMail($pdo, $mail){
    $sql = "SELECT FROM users_info WHERE mail=:mail";
    try{
        $smtp = $pdo->prepare($sql);
        $smtp->bindParam(':mail', $mail);
        return $smtp->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $course = $_POST['course'];
    // 名前
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $lastNameKana = $_POST['lastNameKana'];
    $firstNameKana = $_POST['firstNameKana'];

    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $formattedDate = date("Y/n/j", strtotime($date)). "<br/>";

    $occupation = $_POST['occupation'];
    $school = $_POST['school'];
    $tel = $_POST['tel'];

    // 住所
    $zipcode = $_POST['zipcode'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    session_start();
    $_SESSION['mail'] = $mail;
    $_SESSION['password'] = $password;
    $_SESSION['course'] = $course;
    
    // Checking mail
    $DB = new Database();
    $pdo = $DB->getPDO();
    $isMailExist = searchMail($pdo, $mail);
    $isMailExist ? header("Location: registration.html") /*Error email already exist*/ 
    : header("Location: registration-confirm.html");
}
?>