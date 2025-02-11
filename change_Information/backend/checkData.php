<?php
session_start();
// データの連結
$name = $_POST['lastName']." ".$_POST['firstName'];//漢字
$kana = $_POST['lastKana']." ".$_POST['firstKana'];//カタカナ

require_once '../../core/Database.php';
$db = Database::getInstance();
$pdo = $db -> getPDO();

try {
    $sql = "UPDATE users_info SET name = :name, katakana = :katakana, gender = :gender, birthday = :birthday, occupation = :occupation, school = :school, tel = :tel, address = :address, postalcode = :postalcode, mail = :mail, course = :course WHERE id = :id";
    $stmt = $pdo->prepare($sql);
  
    // 値を入れる！
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':katakana', $kana, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $_POST['gender'], PDO::PARAM_STR);
    $stmt->bindParam(':birthday', $_POST['birthday'], PDO::PARAM_STR);
    $stmt->bindParam(':occupation', $_POST['occupation'], PDO::PARAM_STR);
    $stmt->bindParam(':school', $_POST['school'], PDO::PARAM_STR);
    $stmt->bindParam(':tel', $_POST['tel'], PDO::PARAM_STR);
    $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
    $stmt->bindParam(':postalcode', $_POST['postalcode'], PDO::PARAM_STR);
    $stmt->bindParam(':mail', $_POST['mail'], PDO::PARAM_STR);
    $stmt->bindParam(':course', $_POST['course'], PDO::PARAM_STR);
    $stmt->execute();
    $_SESSION['message'] = "ユーザー情報が正常に更新されました";

    // 実行後のデータを取得するsql
    $selectSql = "SELECT * FROM users_info WHERE id = :id";
    $stmt = $pdo->prepare($selectSql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    header("Location: ../view/change_Information.php");
  
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}
?>