<?php
//session利用開始
session_start();
$mail = $_POST['resetemail'];
$_SESSION['mail'] = $mail;

//メールの設定
    function mailSetting($mail){
        $url = "http://localhost/pass_reset/pass_reset3/new_pass/new_pass.html";
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
            echo 'メール送信が成功しました。';
        } else {
            echo 'メール送信に失敗しました。';
        }
        //header("Location:http://localhost/pass_reset/views/pass_reset.html");
        //exit();

    }
//ここまでメールの設定

        require_once './database.php';
        $pdo = getDb();

        
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


        $maildata = searchData($pdo , $mail);
        if($maildata){
            mailSetting($mail);
        } else {
            echo "入力されたメールアドレスが見つかりませんでした。新規登録をしてください。";
        }

        
//ここまでデータベースの処理
?>