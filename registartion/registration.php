<?php
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

function insertStudentData($pdo, $name, $password){
    $sql = "INSERT INTO users_info (mail, password) VALUES (:mail, :password)";
    try{
        $smtp = $pdo->prepare($sql);
        $smtp->bindParam(':name', $name);
        $smtp->bindParam(':password', $password);
        return $smtp->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

$pdo = getDbConnection();
$results = true;
// $results = insertStudentData($pdo, $name, $password);
if($results){
    header("Location: registration-confirm.php");
} else {
    echo '登録失敗しました';
}
?>