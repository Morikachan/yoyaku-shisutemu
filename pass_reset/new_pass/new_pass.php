<?php
//session利用開始
session_start();
$mail = $_SESSION['mail'];
$newpass = $_POST['reset_pass'];
$repeatpass = $_POST['repeat_pass'];
if($newpass == "" || $repeatpass == ""){
    echo 'パスワードを入力してください。';
} else {
    if($newpass != $repeatpass){
        $alert = "<script type='text/javascript'>alert('同じパスワードを入力してください。');</script>";
        echo $alert;
    } else {
        //データベースのデータの参照
        require_once '../database.php';
        $pdo = getDb();

        //パスワードのリセット処理
        function passreset($pdo , $mail, $newpass){
            $sql = "UPDATE users_info SET passwd = :newpass WHERE mail = :mail";
            $sql = "SELECT * FROM users_info WHERE mail = :mail ";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":mail" , $mail);
                $stmt -> bindParam(":newpass" , $newpass);
                $stmt -> execute();
                // return $stmt -> execute(); // true or false
                $rowsAffected = $stmt -> rowCount();
                return $rowsAffected > 0;
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
        }   
        $result = passreset($pdo,$mail,$newpass);

        if($result){
            echo 'パスワードの変更が完了しました。';
        } else {
            echo "パスワードのリセットに失敗しました \n 何回も続く場合はお問い合わせ画面よりお問い合わせください";
        }
    }
}
?>