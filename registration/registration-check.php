<?php
require_once '../core/Database.php';

$courses = [
    "game" => "ゲームクリエイター学科",
    "design" => "デザイン学科",
    "cs" => "情報処理学科"
];

$occupations = [
    "highschool1" => "高校1年生",
    "highschool2" => "高校2年生",
    "highschool3" => "高校3年生",
    "highschool4" => "高校4年生",
    "university" => "大学生",
    "juniorCollege" => "短大生",
    "vocationalSchool" => "専門学校生",
    "adult" => "社会人",
    "internationalStudent" => "留学生",
    "different" => "その他",
]; 
function searchMail($pdo, $mail){
    $sql = "SELECT * FROM users_info WHERE mail=:mail";
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
    $formattedDate = date("Y-m-d", strtotime($date));

    $occupation = $_POST['occupation'];
    $school = $_POST['school'];
    $tel = $_POST['tel'];

    // 住所
    $zipcode = $_POST['zipcode'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];

    $UserRegistrationInfo = [
        'mail' => $mail,
        'password' => $password,
        'course' => $courses[$course],
        'lastName' => $lastName,
        'firstName' => $firstName,
        'lastNameKana' => $lastNameKana,
        'firstNameKana' => $firstNameKana,
        'gender' => $gender,
        'birthday' => $formattedDate,
        'occupation' => $occupations[$occupation],
        'school' => $school,
        'tel' => $tel,
        'zipcode' => $zipcode,
        'address1' => $address1,
        'address2' => $address2,
      ];

    session_start();
    $_SESSION['mail'] = $mail;
    $_SESSION['password'] = $password;
    $_SESSION['UserRegistrationInfo'] = $UserRegistrationInfo;

    // $_SESSION['error'] =  array();

    $approvedChecked  = !empty($approved) ? true : false;    
    $pdo = Database::getInstance()->getPDO();
    // Checking mail
    $user = searchMail($pdo, $mail);
    if($user){
        $_SESSION['error'] = 'ユーザがすでに存在します';
        header("Location: ./registration.php");
    } else {
        header("Location: ./registration-confirm.php");
    }
}
?>