<?php
const DB_SERVER_NAME = 'localhost';
const DB_USER_NAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'reservationsystem_db';

//データベース接続
function getDBConnection() {
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . ";dbname=" . DB_NAME , DB_USER_NAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e) {
        echo '接続失敗' , $e->getMessage();       
        exit(); 
    }
}

//ユーザーけす
function deletData($pdo , $mail , $passwd){
    
    $sql = 'DELETE FROM users_info WHERE mail = :mail';

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mail' , $mail);
        //
        return $stmt->execute(); 
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

//予約消す
function deletappoint($pdo , $id){
    $sql = "DELETE FROM appointment WHERE id = :id";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id' , $id);
        //
        $stmt->execute();
        $rowsAffected = $stmt->rowCount();
        return $rowsAffected > 0;
    }
    catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

//メールおくる
function sendmail($mail){
    //予約日を表示させる
    session_start();
    $results_mypage = $_SESSION['results_mypage'];

    //送信先 管理者
    $to = 'k248001@kccollege.ac.jp';
    //送信するメールの表題
    $subject = 'アカウント削除';
    //本文
    $message = '<html><body>';
    $message .= '<h1 style="font-size: 20px;">■アカウントが削除されました</h1>';
    $message .= '<div style="margin-left: 20px;">';
    $message .= '<h2 style="font-size: 15px;">● ' . $mail . 'がアカウントを削除しました</h2>';
    if($results_mypage){

        $message .= '<h2 style="font-size: 15px;">● ' . $mail . 'の予約もなくなりました</h2>';
        $message .= '<div style="margin-left: 20px;">';
        $message .= '<table border="2" style="border-collapse: collapse;">';
    
        foreach ($results_mypage as $row){

            $message .= '<tr style="border: 2px solid black;">'
                            .'<th style="border: 2px solid black;">'
                                .'予約日'
                            .'</th>'
                            .'<th style="border: 2px solid black;">'
                                .htmlspecialchars($row['day'])
                            .'</th>'
                            .'<th style="border: 2px solid black;">'
                                .'予約時間'
                            .'</th>'
                            .'<th style="border: 2px solid black;">'
                                .htmlspecialchars($row['time']) . '時'
                            .'</th>'
                        .'</tr>';
        }

        $message .= '</table>';
        $message .= '</div>';
    
    }
    
    $message .= '</div>';
    $message .= '</body></html>';
    //送信元
    $headers = 'From: ' . $mail . "\r\n" .
    'Content-type:text/html;charset=UTF-8' . "\r\n" ;;


    if(mail($to , $subject , $message , $headers)) {
        header('Location: ../html/success.html');
    }
}


session_start();
$pdo = getDBConnection();
$mail = $_SESSION['mail'];
$passwd = $_SESSION['passwd'];
$id = $_SESSION['id'];
$hashPassword = password_hash($passwd, PASSWORD_DEFAULT);
$result = deletData($pdo , $mail , $hashPassword);
if($result){
    $pdo = getDBConnection();
    $mail = $_SESSION['mail'];
    $result = deletappoint($pdo , $id);
    sendmail($mail);
}
else{
    header('Location: ../html/else.html');
}
?>
