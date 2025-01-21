<?php

//pass_reset.htmlの実行後に走る処理です。
//トークンの作成とメールの送信を行っています。
$mail = $_POST['resetemail'];


// password reset token生成
$passwordResetToken = bin2hex(random_bytes(32));
//メールの設定
    function mailSetting($mail,$passwordResetToken){

        $url = "http://localhost/yoyaku-shisutemu/pass_reset/new_pass/new_contact.php?token={$passwordResetToken}";
        //送信先
        $to = $mail;

        //送信するメールの表題
        $subject = 'パスワードリセット用URLをお送りします';

        //本文
        $message = "24時間以内に下記URLへアクセスし、パスワードの変更を完了してください。\r\n";
        $message .= $url;

        //送信元
        $headers = 'From: k248007@kccollege.ac.jp';

        //メールの送信
        if(mail($to, $subject, $message , $headers)) {
            header("Location: ./views/mail_complete.html");
        
        } else {
            header("Location: ./views/mail_error.html");
            exit();
        }
        //header("Location:http://localhost/pass_reset/views/pass_reset.html");
        //exit();

    }
//ここまでメールの設定
//ここからデータベースの処理

//データベースへのアクセス
require_once '../core/Database.php';
$pdo = Database::getInstance()->getPDO();

        //データの検索処理
        function searchData($pdo , $mail){
            $sql = "SELECT * FROM users_info WHERE mail = :mail ";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":mail" , $mail);;
                $stmt -> execute();
                // return $stmt -> execute(); // true or false
                $rowsAffected = $stmt -> rowCount();
                return $rowsAffected > 0;
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
        }    
        //トークンの登録処理
        function insertToken($pdo , $mail, $passwordResetToken){
            if(searchToken($pdo , $mail)){
                $sql = "UPDATE reset_info SET token = :token WHERE  email = :email";
            } else {
                $sql = "INSERT INTO reset_info (email, token) VALUES (:email,:token)";
            }
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":email", $mail);
                $stmt -> bindParam(":token" , $passwordResetToken);
                return $stmt -> execute();
    
    
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
            
        function searchToken($pdo , $mail){
            $sql = "SELECT * FROM reset_info WHERE email = :mail ";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":mail" , $mail);;
                $stmt -> execute();
                // return $stmt -> execute(); // true or false
                $rowsAffected = $stmt -> rowCount();
                return $rowsAffected > 0;
            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }

        }


        $maildata = searchData($pdo , $mail);
        if($maildata){
                mailSetting($mail,$passwordResetToken);
                insertToken($pdo, $mail , $passwordResetToken);
            } else{
                header("Location: ./views/null_mail.html");
                exit();
            }

        
//ここまでデータベースの処理
?>