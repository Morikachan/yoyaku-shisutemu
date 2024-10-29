<?php

$mail = $_POST['resetemail'];

//メールの設定
    function mailSetting($mail){
        //送信先
        $to = $mail;

        //送信するメールの表題
        $subject = 'パスワードリセット用URLをお送りします';

        //本文
        $message = '  24時間以内に下記URLへアクセスし、パスワードの変更を完了してください。';
        {$url}

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



//ここからパスワードリセット用のトークンの作成
    // 既にパスワードリセットのフロー中（もしくは有効期限切れ）かどうかを確認
    // $passwordResetUserが取れればフロー中、取れなければ新規のリクエストということ
    $sql = 'SELECT * FROM `reset_info` WHERE `email` = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $stmt->execute();
    $passwordResetUser = $stmt->fetch(\PDO::FETCH_OBJ);

    if (!$passwordResetUser) {
        // $passwordResetUserがいなければ、仮登録としてテーブルにインサート
        $sql = 'INSERT INTO `reset_info`(`email`, `token`, `token_sent_at`) VALUES(:email, :token, :token_sent_at)';
    } else {
        // 既にフロー中の$passwordResetUserがいる場合、tokenの再発行と有効期限のリセットを行う
        $sql = 'UPDATE `reset_info` SET `token` = :token, `token_sent_at` = :token_sent_at WHERE `email` = :email';
    }

    // password reset token生成
    $passwordResetToken = bin2hex(random_bytes(32));

    // テーブルへの変更とメール送信は原子性を保ちたいため、トランザクションを設置する
    // メール送信に失敗した場合は、パスワードリセット処理自体も失敗させる
    try {
        $pdo->beginTransaction();

        // ユーザーを仮登録
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->bindValue(':token', $passwordResetToken, \PDO::PARAM_STR);
        $stmt->bindValue(':token_sent_at', (new \DateTime())->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
        $stmt->execute();
//ここまでパスワードリセット用のトークンの作成
}
?>