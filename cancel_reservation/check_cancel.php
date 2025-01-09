<?php

    const DB_SERVER_NAME = 'localhost';
    const DB_USER_NAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'reservationsystem_db';

    session_start();

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

    //本人確認
    function checkData($pdo , $mail){
        $sql = "SELECT * FROM users_info WHERE mail = :mail";
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail', $mail);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
        catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    //予約キャンセル
    function deletappoint($pdo , $id , $day , $time ){
        $sql = "UPDATE appointment SET id = :id , day = :day , time = :time , display = 'cancel' WHERE id = :id AND DATE_FORMAT(day, '%Y-%m-%d') = :day AND time = :time  order by day asc;";
    
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id' , $id);
            $stmt->bindParam(':day' , $day);
            $stmt->bindParam(':time' , $time);
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
        //予約日のやつ
        $day_cancel = $_SESSION['day_cancel'];
        $time_cancel = $_SESSION['time_cancel'];
         
        //送信元
        $headers = 'From: ' . $mail . "\r\n" .
    'Content-type:text/html;charset=UTF-8' . "\r\n" ;;

        //送信先 管理者
        $to = 'k248001@kccollege.ac.jp';

        //送信するメールの表題
        $subject = '予約キャンセル';


        //本文
        $message = '<html><body>';
        $message .= '<h1 style="font-size: 20px;">■ 予約がキャンセルされました</h1>';
        $message .= '<div style="margin-left: 20px;">';
        $message .= '<h2 style="font-size: 15px;">● ' . $mail . 'の予約がキャンセルされました</h2>';
        $message .= '<h2 style="font-size: 15px;">● キャンセル内容</h2>';
        $message .= '<div style="margin-left: 20px;">';
        $message .= '<table border="2" style="border-collapse: collapse;">';
        foreach($day_cancel as $key => $day){
            $message .= "<tr style='border: 2px solid black;'>
                            <th style='border: 2px solid black;'>" 
                                . '予約日 ' . "</th><th style='border: 2px solid black;'>"
                                . $day . "</th><th style='border: 2px solid black;'>" 
                                . '予約時間' . "</th><th>" 
                                . $time_cancel[$key] 
                                . '時'
                            ."</th>"
                        ."</tr>";
        }
        $message .= '</table>';
        $message .= '</div>';
        $message .= '</div>';
        $message .= '</body></html>';
        
        
        if(mail($to , $subject , $message , $headers)) {
            header('Location: ./susess.html');
        }
        else{
            //メール用予約キャンセルしたやつを表示
            $day_cancel = $_SESSION['day_cancel'];
            $time_cancel = $_SESSION['time_cancel'];
            for($i=0; $i < count($day_cancel); $i++){
                echo '予約日' . $day_cancel[$i] . '予約時間' . $time_cancel[$i] . '時';
                echo '<br>';
            }
        }
    }


    $pdo = getDBConnection();
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];
    
    $user = checkData($pdo ,  $mail);
    if($user && password_verify($passwd , $user['passwd'])){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // チェックされた行のIDを取得
            if (isset($_POST['selected'])) {
                $selectedIds = $_POST['selected']; // 選択されたIDの配列
        
                //メール用予約キャンセル表示するやつ
                $day_cancel =[];
                $time_cancel = [];
                
                // 選択されたIDごとにデータを取得
                foreach ($selectedIds as $id) {
                    $dayKey = "day_$id";
                    $timeKey = "time_$id";
        
                    if (isset($_POST[$dayKey]) && isset($_POST[$timeKey])) {
                        //メールでの予約キャンセル内容表示用
                        $day_cancel[] = htmlspecialchars($_POST[$dayKey]);
                        $time_cancel[] = htmlspecialchars($_POST[$timeKey]);
                        //予約キャンセル用
                        $day = htmlspecialchars($_POST[$dayKey]);
                        $time = htmlspecialchars($_POST[$timeKey]);
                        $id = $_SESSION['id'];
                        //予約キャンセル
                        $pdo = getDBConnection();
                        deletappoint($pdo , $id , $day , $time);
                    }
                }
                $_SESSION['day_cancel'] = $day_cancel;
                $_SESSION['time_cancel'] = $time_cancel;
                sendmail($mail);
                //header('Location: ./susess.html');
            } 
            else {
                header('Location: ./nonecancel.php');
            }
        }
        
    }
    else{
        header('Location: ./false.php');
    }
    

?>





            
