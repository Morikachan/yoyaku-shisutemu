<?php

$mail = $_POST['resetemail'];

//メールの設定
    function mailSetting($mail){
        //送信先
        $to = 'k248007@kccollege.ac.jp';

        //送信するメールの表題
        $subject = 'テスト';

        //本文
        $message = '送信確認メール';

        //送信元
        $headers = 'From: k248007@kccollege.ac.jp';

        //メールの送信
        if(mail($to, $subject, $message , $headers)) {
            echo 'メール送信が成功しました。';
        } else {
            echo 'メール送信に失敗しました。';
        }
    }
//ここまでメールの設定


//データベース情報
    const DB_SERVER_NAME = 'localhost';
    const DB_USER_NAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'class';
//ここまでデータベース情報
//データベースの処理
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

        //SQL文の設定
        function insertStudentData($pdo , $name, $password){
            $sql = "INSERT INTO users (name,password) VALUES (:name, :password)";
            try{
                //SQL文に入れる値の設定
                $stmt = $pdo->prepare($sql);
                $stmt -> bindParam(":name" , $name);
                $stmt -> bindParam(":password" , $password);
                return $stmt -> execute();


            } catch (PDOException $e){
                echo $e->getMessage();
                return false;
            }
            
        }    

        $pdo = getDbConnection();


        $result = insertStudentData($pdo , $name ,$password);

        mailSetting($mail);
//ここまでデータベースの処理
?>