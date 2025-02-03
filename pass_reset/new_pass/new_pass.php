
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
//データベースのデータの参照
//データベースへのアクセス
require_once '../../core/Database.php';
$pdo = Database::getInstance()->getPDO();

//データの検索処理
function searchData($pdo,$passwordResetToken){
    $sql = "SELECT email FROM reset_info WHERE token = :token";
    try{
        //SQL文に入れる値の設定
        $stmt = $pdo->prepare($sql);
        $stmt -> bindParam(":token" , $passwordResetToken);
        $stmt -> execute();
        $result = $stmt->fetch(); 
        return $result['email'];

        } catch (PDOException $e){
            header('Location: ../../pass_reset/views/databeses_error.html');
            exit();
        } 
}    




//パスワードのリセット処理
function passreset($pdo , $mail, $newpass){
    $sql = "UPDATE users_info SET passwd = :newpass WHERE mail = :mail";
    try{
    $passwordHash = password_hash($newpass, PASSWORD_DEFAULT);
        //SQL文に入れる値の設定
        $stmt = $pdo->prepare($sql);
        $stmt -> bindParam(":newpass" , $passwordHash);
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
    $delete_result = deleteData($pdo , $mail);
    if($delete_result){
    } else {
        header('Location: ../../pass_reset/views/error.html');
        exit();
    }
} else {
    header('Location: ../../pass_reset/views/error.html');
    exit();
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../pass_reset.css">
        <script src="./../../scrollTop.js" defer></script>
    <script src="https://kit.fontawesome.com/f640a591db.js" crossorigin="anonymous"></script>
        <title>パスワードの再設定</title>
    </head>
    <body id="body">
    <script src="../../hamburger.js"></script>
    <header class="c-header c-hamburger-menu">
            <!-- アーツカレッジヨコハマのロゴ -->
            <div class="flex_logo">
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="./../../img/image 1.png" alt="Arts_Logo"></a>
            </div>

            <!-- ロゴを除くオブジェクトを右に固定するためのdiv -->
            <div class="flex_header">    
                
                  <!-- ハンバーガメニューのリスト -->
                  <ul class="c-header__list c-hamburger-menu__list" id="hamburger-menu_list"><!-- 追記 クラスを追記 -->
                      <li class="c-header__list-item">
                        <a href="https://www.kccollege.ac.jp/" class="c-header__list-link">ホームページへ</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./../../inquiry/inquiry.php" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="../../login.php" class="red-button">ログイン</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
    </header>
        <div id="modal" class="modal">
            <div class="modal-content">
                <h4>更新完了</h4>
                <p>パスワードを更新しました。</p>
                <p>ログインしてください</p>
                <a class="return-btn" href="../../login.php">ログインへ</a>
            </div>
        <script src="./new_contact.js"></script>


    </body>
</html>