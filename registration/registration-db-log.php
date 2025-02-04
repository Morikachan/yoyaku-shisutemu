<?php

require_once '../core/Database.php';
    
session_start();
$UserRegistrationInfo = $_SESSION['UserRegistrationInfo'];

function insertStudentData($pdo, $UserRegistrationInfo){
        $sql = "INSERT INTO users_info (mail, passwd, name, katakana, gender, birthday, occupation, school, tel, postalcode, address, course) 
        VALUES (:mail, :passwd, :name, :katakana, :gender, :birthday, :occupation, :school, :tel, :postalcode, :address, :course)";
        try{
            $smtp = $pdo->prepare($sql);
            $passwordHash = password_hash($UserRegistrationInfo['password'], PASSWORD_DEFAULT);
            $fullName = $UserRegistrationInfo['lastName']." ".$UserRegistrationInfo['firstName'];
            $fullNameKana = $UserRegistrationInfo['lastNameKana']." ".$UserRegistrationInfo['firstNameKana'];
            $address = $UserRegistrationInfo['address1'].$UserRegistrationInfo['address2'];

            $smtp->bindParam(':mail', $UserRegistrationInfo['mail']);
            $smtp->bindParam(':passwd', $passwordHash);
            $smtp->bindParam(':name', $fullName);
            $smtp->bindParam(':katakana', $fullNameKana);
            $smtp->bindParam(':gender', $UserRegistrationInfo['gender']);
            $smtp->bindParam(':birthday', $UserRegistrationInfo['birthday']);
            $smtp->bindParam(':occupation', $UserRegistrationInfo['occupation']);
            $smtp->bindParam(':school', $UserRegistrationInfo['school']);
            $smtp->bindParam(':tel', $UserRegistrationInfo['tel']);
            $smtp->bindParam(':postalcode', $UserRegistrationInfo['postalcode']);
            $smtp->bindParam(':address', $address);
            $smtp->bindParam(':course', $UserRegistrationInfo['course']);
            return $smtp->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pdo = Database::getInstance()->getPDO();
            $result = insertStudentData($pdo, $UserRegistrationInfo);
            echo $result ? json_encode(['status' => true]) : json_encode(['status' => false]);
            session_destroy();
    }

    ?>