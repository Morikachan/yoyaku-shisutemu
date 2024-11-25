
<?php 
//パスワードの再設定のviewサイトです。
//最初にトークンの確認処理をしています。

//データベースのデータの参照
require_once '../database.php';
$pdo = getDb();

session_set_cookie_params(60 * 3);
//session利用開始
session_start();
$token = isset($_GET['token']) ? $_GET['token'] : '';
$_SESSION['token'] = $token;
$passwordResetToken = $token;

$timezone = new dateTimeZone('Asia/Tokyo');
$nowtime = new DateTime('now',$timezone);
$nowtime ->format('Y-m-d H:i:s');


//トークンの期限確認
// 今回はtokenの有効期間を24時間とする
function token_time($pdo,$passwordResetToken){
    // tokenに合致するユーザーを取得
        $sql = 'SELECT * FROM `reset_info` WHERE `token` = :token';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':token', $passwordResetToken, \PDO::PARAM_STR);
        $stmt->execute();
        $passwordResetuser = $stmt->fetch(\PDO::FETCH_OBJ);
        //トークンの制限時間を10秒とする。
        // $date = getAsiaTime($passwordResetuser -> token_sent_at)-> modify('+10 second')-> format('Y-m-d H:i:s');


        //トークンの制限時間を24時間とする。
        $date = getAsiaTime($passwordResetuser -> token_sent_at)-> modify('+24 hour')-> format('Y-m-d H:i:s');

        
        $nowtime = getAsiaTime()->format('Y-m-d H:i:s');
        if ($date < $nowtime) {
            $mail = searchData($pdo, $passwordResetToken);
            deleteData($pdo , $mail);
            header("Location:http://localhost/yoyaku-shisutemu/pass_reset/views/token_timeout.html");
            exit();
        }            
}

function getAsiaTime($strTime = 'now'){
    $timezone = new dateTimeZone('Asia/Tokyo');
    return new DateTime($strTime,$timezone);
}

//データの検索処理
function searchData($pdo,$passwordResetToken){
$sql = "SELECT email FROM reset_info WHERE token = :token";
try{
    //SQL文に入れる値の設定
    $stmt = $pdo->prepare($sql);
    $stmt -> bindParam(":token" , $passwordResetToken);
    $stmt -> execute();
    $result = $stmt->fetch(); 
    return $result[0];
    
    } catch (PDOException $e){
        header("Location:http://localhost/yoyaku-shisutemu/pass_reset/views/databeses_error.html");
        exit();
    } 
}  
//  データベースにメアドがあるかの確認
function searchToken($pdo,$passwordResetToken){
    $sql = "SELECT email FROM reset_info WHERE token = :token";
    try{
        //SQL文に入れる値の設定
        $stmt = $pdo->prepare($sql);
        $stmt -> bindParam(":token" , $passwordResetToken);
        $stmt -> execute();
        $rowsAffected = $stmt -> rowCount();
        return $rowsAffected > 0;
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
if(searchToken($pdo, $passwordResetToken)){
    token_time($pdo,$passwordResetToken);
} else {
    header("Location:http://localhost/yoyaku-shisutemu/pass_reset/views/token_timeout.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../pass_reset.css">
    <title>パスワードの再設定</title>
</head>
<body id="body">
    <script src="../../hamburger.js"></script>
    <header class="c-header c-hamburger-menu">

            <!-- アーツカレッジヨコハマのロゴ -->
            <div class="flex_logo">
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../../img/image 1.png" alt="Arts_Logo"></a>
            </div>

            <!-- ロゴを除くオブジェクトを右に固定するためのdiv -->
            <div class="flex_header">    
                
                  <!-- ハンバーガメニューのリスト -->
                  <ul class="c-header__list c-hamburger-menu__list" id="hamburger-menu_list"><!-- 追記 クラスを追記 -->
                      <li class="c-header__list-item">
                        <a href="https://www.kccollege.ac.jp/" class="c-header__list-link">ホームページへ</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="#" class="c-header__list-link">参加履歴</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="#" class="c-header__list-link">登録内容の変更</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="#" class="c-header__list-link">アカウント削除</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="#" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="#" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
        
    </header>
    <main id="main">
        <h1>パスワードリセット</h1>
        
        
        <div class="content-container">
            <form action="./new_pass.php" method="POST">
                <label>
                    新しいパスワード
                    <input type="password" name="reset_pass">
                </label>
                <br>
                <label>
                    パスワード（確認用）
                    <input type="password" name="repeat_pass">
                </label>
                <br>
                <button type="submit">送信する</button>
            </form>
        </div>
    </main>
</body>
</html>