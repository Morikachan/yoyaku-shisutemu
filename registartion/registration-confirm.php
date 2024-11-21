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
    <title>新規登録確認</title>
</head>
<body>
    <header>
        <div class="header-wrap">
            <p><img src="../img/image 1.png" alt="Arts_Logo"></p>
            <p><a href="#" class="red-button">新規登録</a></p>
            <div/>
            <div class="nav-wrap">
                <!-- ハンバーガーメニュー部分 -->
                
                <!--ここまででハンバーガメニュー終わり-->
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