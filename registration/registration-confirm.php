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
                        <span class="required">必須</span><h3>メールアドレス</h3>
                            <input type="text" name="mail" id="mail" value=<?php echo $UserRegistrationInfo['mail'] ?> readonly>  
                    <h2>個人情報</h2>
                        <span class="required">必須</span><h3>氏名</h3>
                        <div>
                            <h4>姓・名</h4>
                            <div class="name-container">
                                <input type="text" name="lastName" id="lastName" value=<?php echo $UserRegistrationInfo['lastName'] ?> readonly>
                                <input type="text" name="firstName" id="firstName" value=<?php echo $UserRegistrationInfo['firstName'] ?> readonly>
                            </div>
                            <h4>姓・名（フリガナ）</h4>
                            <div class="name-container">
                                <input type="text" name="lastNameKana" id="lastNameKana" value=<?php echo $UserRegistrationInfo['lastNameKana'] ?> readonly>
                                <input type="text" name="firstNameKana" id="firstNameKana" value=<?php echo $UserRegistrationInfo['firstNameKana'] ?> readonly>
                            </div>
                        </div>
                        <span class="required">必須</span><h3>性別</h3>
                            <input type="text" name="gender" id="gender" value=<?php echo $UserRegistrationInfo['gender'] ?> readonly>
                        <span class="required">必須</span><h3>生年月日</h3>
                            <input type="date" name="date" id="date" value=<?php echo $UserRegistrationInfo['birthday'] ?> readonly>
                        <span class="required">必須</span><h3>希望学科</h3>
                            <!-- <input type="text" name="course" id="course" value=<?php echo $UserRegistrationInfo['course'] ?> required readonly> -->
                            <select name="course" id="course">
                                <option value="course"><?php echo $UserRegistrationInfo['course'] ?></option>
                            </select>
                        <span class="required">必須</span><h3>職業</h3>
                            <select name="occupation" id="occupation">
                                <option value="occupation"><?php echo $UserRegistrationInfo['occupation']?></option>
                            </select>
                        <label for="school"><h3>出身学校</h3></label>
                            <input type="text" name="school" id="school" value=<?php echo $UserRegistrationInfo['school'] ?> readonly>
                        <span class="required">必須</span><h3>電話番号</h3>
                            <input type="tel" name="tel" id="tel" value=<?php echo $UserRegistrationInfo['tel'] ?> readonly>
                        <span class="required">必須</span><h3>住所</h3>
                            <input type="text" name="zipcode" id="zipcode" value=<?php echo $UserRegistrationInfo['zipcode'] ?> readonly>
                            <div class="address">
                                <input type="text" name="address1" id="address1" value=<?php echo $UserRegistrationInfo['address1'] ?> readonly>
                                <input type="text" name="address2" id="address2" value=<?php echo $UserRegistrationInfo['address2'] ?> readonly>
                            </div>
                            <div class="registration-confirm-buttons">
                                <button type="button" class="login-submit" onclick="history.back()">戻る</button>
                                <button type="button" method="post" class="login-submit" id="modalBtn">登録</button>
                            </div>
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