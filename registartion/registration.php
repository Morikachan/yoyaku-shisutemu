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
    $UserRegistrationInfo->address1 = $address1;
    $UserRegistrationInfo->address2 = $address2;

    session_start();
    $_SESSION['mail'] = $mail;
    $_SESSION['password'] = $password;
    $_SESSION['UserRegistrationInfo'] = $UserRegistrationInfo;

    $approvedChecked  = !empty($approved) ? true : false;    
    // Checking mail
    $DB = new Database();
    $pdo = $DB->getPDO();
    $isMailExist = searchMail($pdo, $mail);
    $isMailExist && $approvedChecked ? header("Location: registration.html") /*Error email already exist*/ 
    : header("Location: registration-confirm.html");
}
?>