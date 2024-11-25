<?php 
    session_start();
    if(empty($_SESSION['UserRegistrationInfo'])){
        header("Location: ./registration.php");
    }
    $UserRegistrationInfo = $_SESSION['UserRegistrationInfo'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./registration_style.css">
    <script src="../login.js"></script>
    <title>新規登録確認</title>
</head>
<body>
    <header class="c-header c-hamburger-menu">

            <!-- アーツカレッジヨコハマのロゴ -->
            <div class="flex_logo">
                <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../img/image 1.png" alt="Arts_Logo"></a>
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
            <main>
                <h1 id="h1">新規登録確認</h1>
                <div class="content-container">
                    <?php if(isset($_SESSION['error'])):?>
                        <div class="error-message">
                            <?php echo $_SESSION['error'] ?>
                        </div>
                        <?php unset($_SESSION['error']);?>
                        <?php endif;?>
                        <h2>ログイン情報</h2>
                        <span class="required">必須</span>
                        <h3>メールアドレス</h3>
                            <p id="mail"> <?php echo $UserRegistrationInfo['mail'] ?></p>
                    <h2>個人情報</h2>
                        <span class="required">必須</span><h3>希望学科</h3>
                            <p id="course"> <?php echo $UserRegistrationInfo['course'] ?></p>
                        <span class="required">必須</span><h3>氏名</h3>
                        <div>
                            <div>
                                <span>性:</span>
                                <p id="lastName"> <?php echo $UserRegistrationInfo['lastName'] ?></p>
                                <span>名:</span>
                                <p id="firstName"> <?php echo $UserRegistrationInfo['firstName'] ?></p>
                            </div>
                            <div>
                                <span>セイ:</span>
                                    <p id="lastName"> <?php echo $UserRegistrationInfo['lastNameKana'] ?></p>
                                    <span>メイ:</span>
                                    <p id="firstName"> <?php echo $UserRegistrationInfo['firstNameKana'] ?></p>
                                </div>
                            </div>
                        <span class="required">必須</span><h3>性別</h3>
                            <p id="gender"> <?php echo $UserRegistrationInfo['gender'] ?></p>
                        <span class="required">必須</span><h3>生年月日</h3>
                            <p id="date"> <?php echo $UserRegistrationInfo['birthday'] ?></p>
                            <span class="required">必須</span><h3>職業</h3>
                            <p id="occupation"> <?php echo $UserRegistrationInfo['occupation']?></p>
                            <label for="school"><h3>出身学校</h3></label>
                            <p id="school"> <?php echo $UserRegistrationInfo['school'] ?></p>
                            <span class="required">必須</span><h3>電話番号</h3>
                            <p id="tel"> <?php echo $UserRegistrationInfo['tel'] ?></p>
                            <span class="required">必須</span><h3>住所</h3>
                            <p id="zipcode"> <?php echo $UserRegistrationInfo['zipcode'] ?></p>
                            <div class="address">
                                <p id="address1"> <?php echo $UserRegistrationInfo['address1'] ?></p>
                                <p id="address2"> <?php echo $UserRegistrationInfo['address2'] ?></p>
                            </div>
                            <button type="button" method="post" class="login-submit" id="modalBtn">登録</button>
                            <div id="modal" class="modal">
                                <div class="modal-content">
                                    <h4>登録完了</h4>
                                    <p>登録できました</p>
                                    <p>ログインしてください</p>
                                    <a class="return-btn" href="../login.php">ログインへ</a>
                            </div>
                        </div>
                </div>
            </main>
            <script src="./modal-window.js" defer></script>
</body>
</html>