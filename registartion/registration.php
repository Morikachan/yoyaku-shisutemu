<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./registration_style.css">
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
    <title>新規登録</title>
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
                <?php if(isset($_SESSION['error'])):?>
                    <div class="error-message"></div>
                    <?php unset($_SESSION['error']);?>
                <?php endif;?>
                <form action="registration-check.php" method="post" class="h-adr">
                    <h2>ログイン情報</h2>
                        <span class="required">必須</span>
                        <label for="email"><h3>メールアドレス</h3></label>
                            <input type="email" name="mail" id="mail">
                        <span class="required">必須</span>
                        <label for="password"><h3>パスワード</h3></label>
                            <input type="password" name="password" id="password">
                        <span class="required">必須</span>
                        <label for="password_check"><h3>パスワード確認</h3></label>
                            <input type="password" name="password_check" id="password_check">

                    <h2>個人情報</h2>
                        <span class="required">必須</span><h3>氏名</h3>
                            <div>
                                <div>
                                    <input type="text" name="lastName" id="lastName" placeholder="性" value="">
                                    <input type="text" name="firstName" id="firstName" placeholder="名" value="">
                                </div>
                                <div>
                                    <input type="text" name="lastNameKana" id="lastNameKana" placeholder="セイ" value="">
                                    <input type="text" name="firstNameKana" id="firstNameKana" placeholder="メイ" value="">
                                </div>
                            </div>
                        <div>
                            <span class="required">必須</span><h3>性別</h3>
                            <div>
                                <label><input type="radio" name="gender" value="女性">女性</label>
                                <label><input type="radio" name="gender" value="男性">男性</label>
                            </div>
                        </div>
                        <span class="required">必須</span><h3>生年月日</h3>
                            <input type="date" name="date" id="date"/>
                        <span class="required">必須</span><h3>希望学科</h3>
                            <select name="course" id="course">
                                <option value="">選択してください</option>
                                <option value="game">ゲームクリエイター学科</option>
                                <option value="design">デザイン学科</option>
                                <option value="cs">情報処理学科</option>
                            </select>
                        <span class="required">必須</span><h3>職業</h3>
                        <select name="occupation">
                            <option value="">選択してください</option>
                            <option value="highschool1">高校1年生</option>
                            <option value="highschool2">高校2年生</option>
                            <option value="highschool3">高校3年生</option>
                            <option value="highschool3">高校4年生</option>
                            <option value="university">大学生</option>
                            <option value="juniorCollege">短大生</option>
                            <option value="vocationalSchool">専門学校生</option>
                            <option value="adult">社会人</option>
                            <option value="internationalStudent">留学生</option>
                            <option value="different">その他</option>
                        </select>
                        
                        <span class="required">必須</span>
                        <label for="school"><h3>出身学校</h3></label>
                        <input type="text" name="school" id="school">

                        <span class="required">必須</span>
                        <label for="school"><h3>電話番号</h3></label>
                            <input type="tel" name="tel" id="tel" required />
                        
                        <span class="required">必須</span><h3>住所</h3>
                            <span class="p-country-name" style="display:none;">Japan</span>
                               <input type="text" class="p-postal-code" size="8" maxlength="8" id="zipcode" placeholder="〒">
                            <div class="address">
                                <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address1" id="address1" />
                                <input type="text" class="" name="address2" id="address2" />
                            </div>
                            <p>
                                <input type="checkbox" name="approved" id="approved">
                                個人情報の保護に同意します。<br/>
                        </p>
                        <button type="submit" class="login-submit">確認画面へ</button>
                </form>
            </div>
    </main>
</body>
</html>