<?php
session_start();
// データの連結
$name = $_POST['lastName']."　".$_POST['firstName'];//漢字
$kana = $_POST['lastKana']."　".$_POST['firstKana'];//カタカナ


//ーーーーーーーーーーーーーーーーーーーーここから下は消す予定ーーーーーーーーーーーーーーーーーーーー
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'test';
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['message'] = '接続失敗';
    exit();
}
//ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
// 下で代用↓↓↓↓
// require_once '../../core/Database.php';

try {
    $sql = "UPDATE user_info SET name = :name, katakana = :katakana, gender = :gender, birthday = :birthday, occupation = :occupation, school = :school, tel = :tel, address = :address, postalcode = :postalcode, mail = :mail, course = :course WHERE id = :id";
    //本来はこちらのsqlを使用します
    // $sql = "UPDATE users_info SET name = :name, katakana = :katakana, gender = :gender, birthday = :birthday, occupation = :occupation, school = :school, tel = :tel, address = :address, mail = :mail, course = :course WHERE id = :id";
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
    $selectSql = "SELECT * FROM user_info WHERE id = :id";
    $stmt = $pdo->prepare($selectSql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['results'] = $results;
    header("Location: ../view/change_Information.php");
  
} catch (PDOException $e) {
    $_SESSION['message'] =  "エラーが発生しました: " . $e->getMessage();
}
?>