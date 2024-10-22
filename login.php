<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン確認</title>
</head>
<body>
    <h1>ログイン確認</h1>
    <?php
    session_start();
    // データベースに接続するための情報 ---------------------- <<<
    //     const DB_SERVER_NAME = 'localhost';
    //     const DB_USER_NAME = 'root';
    //     const DB_PASSWORD = '';
    //     const DB_NAME = 'reservationsystem_db';
    // // ------------------------------------------------------ >>>
    
    // login.htmlから値を貰う ------ <<<
        $mail = $_POST['mail'];
        $passwd = $_POST['passwd'];
        $passHash;
    // ----------------------------- >>>

    session_start();
    $_SESSION['mail'] = $mail;
    $_SESSION['passwd'] = $passwd;

    header("Location: mypage.html");
    exit();

    // // データベース接続 ----------------------------------------------------------------------- <<<
    //     function getDbConnection() {
    //         try {
    //             $pdo = new PDO("mysql:host=" . DB_SERVER_NAME . 
    //             ";dbname=" . DB_NAME,DB_USER_NAME,DB_PASSWORD);
    //             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //             return $pdo;
    //         } catch (PDOException $e) {
    //             echo '接続失敗' . $e->getMessage();
    //             exit();
    //         }
    //     }
    // // --------------------------------------------------------------------------------------- >>>
    
    // // sqlの作成 ---------------------------------------- <<<
    //     function loginUserData($pdo,$mail,$passwd) {
    //         $sql = "";
    //         try {
    //             $stmt = $pdo->prepare($sql);
    //             $stmt->bindParam(':mail',$mail);
    //             $stmt->bindParam(':passwd',$passwd);
    //             return $stmt->execute();
    //         } catch (PDOException $e) {
    //             echo $e->getMessage();
    //             return false;
    //         }
    //     }
    // -------------------------------------------------- >>>
    
    
    
    ?>
</body>
</html>