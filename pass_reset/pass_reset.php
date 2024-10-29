<?php

$mail = $_POST['resetemail'];

//メールの設定
    function mailSetting($mail){
        $url = "http://localhost/pass_reset/views/pass_reset.html";
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


//データベース情報
    const DB_SERVER_NAME = 'localhost';
    const DB_USER_NAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'reservationsystem_db';
//ここまでデータベース情報
//データベースの処理
        //SQL文の設定

        function getDbConnection() {
            try {
                $pdo = new PDO("mysql:host=" . DB_SERVER_NAME .
                ";dbname=" . DB_NAME, DB_USER_NAME, DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch (PDOException $e) {
                echo '接続失敗' . $e->getMessage();
                exit();
            }
        }
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

        $pdo = getDbConnection();


        $maildata = searchData($pdo , $mail);
        if($maildata){
            mailSetting($mail);
        } else {
            echo "入力されたメールアドレスが見つかりませんでした。新規登録をしてください。";
        }

        
//ここまでデータベースの処理
?>