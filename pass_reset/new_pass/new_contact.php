
<?php 
//パスワードの再設定のviewサイトです。
//最初にトークンの確認処理をしています。

//データベースのデータの参照
//データベースへのアクセス
require_once '../../core/Database.php';
$pdo = Database::getInstance()->getPDO();

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
        //$date = getAsiaTime($passwordResetuser -> token_sent_at)-> modify('+1 second')-> format('Y-m-d H:i:s');


        //トークンの制限時間を24時間とする。
        $date = getAsiaTime($passwordResetuser -> token_sent_at)-> modify('+24 hour')-> format('Y-m-d H:i:s');

        
        $nowtime = getAsiaTime()->format('Y-m-d H:i:s');
        if ($date < $nowtime) {
            $mail = searchData($pdo, $passwordResetToken);
            deleteData($pdo , $mail);
            header('Location: ../../pass_reset/views/token_timeout.html');
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
        header('Location: ../../pass_reset/views/databeses_error.html');
        $mail = searchData($pdo, $passwordResetToken);
        deleteData($pdo , $mail);
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
    $mail = searchData($pdo, $passwordResetToken);
    deleteData($pdo , $mail);
    header('Location: ../../pass_reset/views/token_timeout.html');
    
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
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="img/image 1.png" alt="Arts_Logo"></a>
            </div>

            <!-- ロゴを除くオブジェクトを右に固定するためのdiv -->
            <div class="flex_header">    
                
                  <!-- ハンバーガメニューのリスト -->
                  <ul class="c-header__list c-hamburger-menu__list" id="hamburger-menu_list"><!-- 追記 クラスを追記 -->
                      <li class="c-header__list-item">
                        <a href="https://www.kccollege.ac.jp/" class="c-header__list-link">ホームページへ</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./../../participation_history/participation_history.html" class="c-header__list-link">参加履歴</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./../../change_Information/view/change_Information.php" class="c-header__list-link">登録内容の変更</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./../../delete_account/html/delete.html" class="c-header__list-link">アカウント削除</a>
                      </li>
                      <li class="c-header__list-item">
                        <a href="./../../inquiry/inquiry.html" class="c-header__list-link">お問い合わせ</a>
                      </li>
                  </ul>
                  
                  <!-- 新規登録ボタン -->
                  <a href="./registration/registration.php" class="red-button">新規登録</a>
                  <!-- ハンバーガボタン -->
                  <div id="hamburger-btn" class="open" onclick="hamburgerClick()"></div>
            </div>
    </header>
        <main id="main">
            <h1>パスワードリセット</h1>
            
            
            <div class="content-container">
                <div class="alert_message">・パスワードが一致しません</div>
                <div class="alert_message2">・8文字以上で設定してください</div>
                <div class="alert_message3">・24文字以下で設定してください</div>
                <div class="alert_message4">・大文字と小文字、数字をそれぞれ１つ以上パスワードにいれてください。</div>
                <form action="./new_pass.php" method="POST">
                    <label>
                        <h3>新しいパスワード</h3>
                        <input type="password" class="input" name="reset_pass" id="reset_pass">
                    </label>
                    <br>
                    <label>
                        <h3>パスワード（確認用）</h3>
                        <input type="password" class="input2" name="repeat_pass" id="repeat_pass">
                    </label>
                    <br>
                    <button type="submit" class="login-submit" id="sendButton" disabled>送信する</button>
                    </form>
                </div>
            </main>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <!-- CONTACT INFO + SNS -->
                <h3>お問い合わせの情報</h3>
                <div>
                    <p>アーツカレッジヨコハマ</p>
                    <p>〒220-0072</p>
                    <p>神奈川県横浜市西区浅間町2-105-8</p>
                    <p> TEL：
                        <a href="tel:0120-557-754">0120-557-754</a>
                        （平日9〜17時）
                    </p>
                    <p>MAIL：
                        <a href="mailto:master@kccollege.ac.jp">master@kccollege.ac.jp</a>
                    </p>
                    <a href="#">お問い合わせフォームへ</a>
                    <div class="icons">
                        <a href="https://twitter.com/artscollege" class="twitter"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/artscollegeofficial/" class="insta"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://lin.ee/tqexEQX" class="line"><i class="fa-brands fa-line"></i></a>
                        <a href="https://www.youtube.com/channel/UCADAYqNIxMTkg2OE8_5aNzA/" class="youtube"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://ja-jp.facebook.com/artscollegeyokohama" id="facebook"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-section">
                <!-- ACCESS -->
                <h3>アクセス</h3>
                <div>
                    <p>横浜駅西口より徒歩15分 相鉄線平沼橋駅より徒歩11分</p>
                    <p>横浜駅西口ターミナルからバス25、202系統</p>
                    <p>「浅岡橋」バス停下車徒歩2分</p>  
                </div>
            </div>
            <div class="footer-section">
                <!-- MAP -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6499.293489360595!2d139.609711!3d35.463539!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60185c09e09a76a5%3A0xd9f33045278944be!2z44Ki44O844OE44Kr44Os44OD44K444Oo44Kz44OP44Oe!5e0!3m2!1sja!2sjp!4v1736212708651!5m2!1sja!2sjp" width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <small>Copyright　&copy;システム開発Cチーム　2025</small>
    </footer>
    <a id="page-top">TOP</a>
    <script src="./new_contact.js"></script>
</body>
</html>