<?php

    const DB_SERVER_NAME = 'localhost';
    const DB_USER_NAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'reservationsystem_db';

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
    function deletappoint($pdo , $mail , $day , $time){
        $sql = "DELETE FROM appointment WHERE mail = :mail AND DATE_FORMAT(day, '%Y/%m/%d') = :day AND time = :time";
    
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':mail' , $mail);
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

    $pdo = getDBConnection();
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];
    $user = checkData($pdo ,  $mail);
    if($user && password_verify($passwd , $user['passwd'])){
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // チェックされた行のIDを取得
            if (isset($_POST['selected'])) {
                $selectedIds = $_POST['selected']; // 選択されたIDの配列
        
                // 選択されたIDごとにデータを取得
                foreach ($selectedIds as $id) {
                    $dayKey = "day_$id";
                    $timeKey = "time_$id";
        
                    if (isset($_POST[$dayKey]) && isset($_POST[$timeKey])) {
                        $day = htmlspecialchars($_POST[$dayKey]);
                        $time = htmlspecialchars($_POST[$timeKey]);
                        $pdo = getDBConnection();
                        deletappoint($pdo , $mail , $day , $time);
                    }
                    header('Location: ./susess.html');
                }
        
            } else {
                header('Location: ./nonecancel.php');
            }
        }
        
    }
    else{
        header('Location: ./false.php');
    }
    

?>
