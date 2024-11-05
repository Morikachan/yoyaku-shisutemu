<?php 

    session_start();


    $result = 'yes';
    echo $result == 'yes' ?'true' : 'false';

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
        <h1>新規登録</h1>
            <div class="content-container">
                <form action="registration.php" method="post">
                    <h2>ログイン情報</h2>
                        <span class="required"></span>
                        <label for="email"><h3>メールアドレス</h3></label>
                            <p id="mail"> <?php  ?></p>
                        <span class="required"></span>
                        <label for="password"><h3>パスワード</h3></label>
                            <input type="password" name="password" id="password">
                        <span class="required"></span>
                        <label for="password_check"><h3>パスワード確認</h3></label>
                            <input type="password_check" name="password_check" id="password_check">

                    <h2>個人情報</h2>
                        <span class="required"></span><h3>希望学科</h3>
                            <select name="course" id="course">
                                <option value="">選択してください</option>
                                <option value="game">ゲームクリエイター学科</option>
                                <option value="design">デザイン学科</option>
                                <option value="cs">情報処理学科</option>
                            </select>
                        <span class="required"></span><h3>氏名</h3>
                            <div>
                                <div>
                                    <input type="text" name="lastName" id="lastName" value="性">
                                    <input type="text" name="firstName" id="firstName" value="名">
                                </div>
                                <div>
                                    <input type="text" name="lastNameKana" id="lastNameKana" value="セイ">
                                    <input type="text" name="firstNameKana" id="firstNameKana" value="メイ">
                                </div>
                            </div>
                        <span class="required"></span><h3>性別</h3>
                            <label><input type="radio" name="gender" value="女性">女性</label>
                            <label><input type="radio" name="gender" value="男性">男性</label>
                        <span class="required"></span><h3>生年月日</h3>
                            <input type="date" name="date" id="date"/>
                        <span class="required"></span><h3>職業</h3>
                        <select name="occupation">
                            <option value="">選択してください</option>
                            <option value="game">ゲームクリエイター学科</option>
                            <option value="design">デザイン学科</option>
                            <option value="cs">情報処理学科</option>
                        </select>
                        <label for="school"><h3>出身学校</h3></label>
                            <input type="text" name="school" id="school">
                        <span class="required"></span><h3>電話番号</h3>
                            <input type="tel" name="tel" id="tel" required />
                        
                        <span class="required"></span><h3>住所</h3>
                            <div class="address">
                                <input type="text" name="zipcode" id="zipcode">
                                <button onclick="">検索</button>
                                <input type="text" name="address1" id="address1">
                                <input type="text" name="address2" id="address2">
                            </div>
                        <p>
                            <input type="checkbox" name="approved" id="approved">
                            個人情報の保護に同意します。<br/>
                        </p>
                        <button type="submit" class="regist-submit" id="myBtn">登録</button>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                              <span class="close">&times;</span>
                              <p>登録できました。ログインしてください</p>
                              <a href="../login.html">ログインへ</a>
                            </div>
                        </div>
                </form>
            </div>
    </main>
</body>
</html>