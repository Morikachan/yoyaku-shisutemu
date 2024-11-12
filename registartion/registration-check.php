<?php
require_once '../core/Database.php';
function searchMail($pdo, $mail){
    $sql = "SELECT FROM users_info WHERE mail=:mail";
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
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
    // フルネーム
    $fullName = $lastName.' '.$firstName;
    $fullNameKana = $lastNameKana.' '.$firstNameKana;

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

    $approved = $_POST['approved'];

    $UserRegistrationInfo = new stdClass();
    // Added property to the object
    $UserRegistrationInfo->mail = $mail;
    $UserRegistrationInfo->password = $password;
    $UserRegistrationInfo->course = $course;

    $UserRegistrationInfo->lastName = $lastName;
    $UserRegistrationInfo->firstName = $firstName;
    $UserRegistrationInfo->lastNameKana = $lastNameKana;
    $UserRegistrationInfo->firstNameKana = $firstNameKana;

    $UserRegistrationInfo->gender = $gender;
    $UserRegistrationInfo->date = $formattedDate;

    $UserRegistrationInfo->occupation = $occupation;
    $UserRegistrationInfo->school = $school;
    $UserRegistrationInfo->tel = $tel;

    $UserRegistrationInfo->zipcode = $zipcode;
    $UserRegistrationInfo->address = $address;

    session_start();
    $_SESSION['mail'] = $mail;
    $_SESSION['password'] = $password;
    $_SESSION['UserRegistrationInfo'] = $UserRegistrationInfo;

    $_SESSION['error'] =  array();

    $approvedChecked  = !empty($approved) ? true : false;    
    $pdo = Database::getInstance()->getPDO();
    // Checking mail
    $user = searchMail($pdo, $mail);
    if(!empty($user) && !$approvedChecked){
        array_push($_SESSION['error'], 'ユーザがすでに存在します');
        header("Location: ./registration.php");
    } else {
        header("Location: ./registration-confirm.html");
    }
}
?>