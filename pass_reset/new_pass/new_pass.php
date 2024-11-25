
<?php
//new_contact.phpを実行した後に走る処理です。
//パスワードの再設定処理とトークンの削除を行っています。

$newpass = $_POST['reset_pass'];
$repeatpass = $_POST['repeat_pass'];
session_start();
$token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
$passwordResetToken = $token;
// 今回はtokenの有効期間を24時間とする
// $tokenValidPeriod = (new \DateTime())->modify("-24 hour")->format('Y-m-d H:i:s');

//4分とする
// $tokenValidPeriod = (new \DateTime())->modify("-4 minute")->format('Y-m-d H:i:s');

//10秒とする
// $tokenValidPeriod = (new \DateTime())->modify("-10 second")->format('Y-m-d H:i:s');

if($newpass == "" || $repeatpass == ""){
    $mail = searchData($pdo, $passwordResetToken);
    deleteData($pdo , $mail);
    header("Location:http://yoyaku-shisutemu/pass_reset/views/null_pass.html");
    exit();
} else {
    if($newpass != $repeatpass){
        $mail = searchData($pdo, $passwordResetToken);
        deleteData($pdo , $mail);
        header("Location:http://yoyaku-shisutemu/pass_reset/views/pass_same.html");
        exit();
    } else {
        //データベースのデータの参照
        require_once '../database.php';
        $pdo = getDb();

         //データの検索処理
         function searchData($pdo,$passwordResetToken){
            $sql = "SELECT email FROM reset_info WHERE token = :token";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":token" , $passwordResetToken);
                $stmt -> execute();
                $result = $stmt->fetch(); 
                return $result[0];

                } catch (PDOException $e){
                    header("Location:http://yoyaku-shisutemu/pass_reset/views/databeses_error.html");
                    exit();
                } 
        }    


           
        
        //パスワードのリセット処理
        function passreset($pdo , $mail, $newpass){
            $sql = "UPDATE users_info SET passwd = :newpass WHERE mail = :mail";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":newpass" , $newpass);
                $stmt -> bindParam(":mail" , $mail);
                //$stmt -> execute();
                return $stmt -> execute(); // true or false
                //$rowsAffected = $stmt -> rowCount();
                //echo $rowsAffected;
                //return $rowsAffected > 0;
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
        }   

        //トークンの削除
        function deleteData($pdo , $mail){
            $sql = "DELETE FROM reset_info WHERE email = :mail";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":mail", $mail);
               //ここから修正
                //return $stmt -> execute();
                return $stmt -> execute();
                //ここまで
    
                //例外処理
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
        }    
        $mail = searchData($pdo, $passwordResetToken);
        $reset_result = passreset($pdo,$mail,$newpass);
        if($reset_result){
            header("Location:http://yoyaku-shisutemu/pass_reset/views/complete.html");
            $delete_result = deleteData($pdo , $mail);

            if($delete_result){
                header("Location:http://localhost/yoyaku-shisutemu/pass_reset/views/complete.html");
                exit();
            } else {
                header("Location:http://yoyaku-shisutemu/pass_reset/views/error.html");
                exit();
            }
        } else {
            header("Location:http://yoyaku-shisutemu/pass_reset/views/error.html");
            exit();
        }
    }
}
?>