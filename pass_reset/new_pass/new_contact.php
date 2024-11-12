
<?php 
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
            exit('有効期限外です');
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
        echo '取得失敗';
        exit();
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
token_time($pdo,$passwordResetToken);
?>


<p>パスワードリセット</p>


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