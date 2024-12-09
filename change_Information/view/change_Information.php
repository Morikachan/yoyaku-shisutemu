<?php
session_start();
$results = $_SESSION['results'];
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../login.js"></script>
    <title>登録情報の変更</title>
</head>
<body>
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
    <main>
        <h1>登録情報の変更</h1>
        <div class="content-container">
            <!-- inputに予めvalueで値を入れておく -->
            <form action="../backend/checkData.php" method="post">
                <?php foreach ($results as $row): ?>
                    <!-- 名前や電話番号を区切って配列に入れています -->
                    <?php
                        $name = explode("　",$row['name']);
                        $katakana = explode("　",$row['katakana']);
                        $tel = explode("-",$row['tel']);
                    ?>
                    <table border="0">
                        <tr>
                            <th>名前</th>
                            <td>
                                <input class="nameSpace" name="lastName" type="text" value=<?php echo $name[0]?> placeholder="性" required>
                                <input class="nameSpace" name="firstName" type="text" value=<?php echo $name[1]?> placeholder="名" required>
                                <br>
                                <input class="nameSpace" name="lastKana" type="text" value=<?php echo $katakana[0]?> placeholder="セイ" required>
                                <input class="nameSpace" name="firstKana" type="text" value=<?php echo $katakana[1]?> placeholder="メイ" required>
                            </td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td>
                                <div>
                                    <label class="fontSizeChange">
                                        <input type="radio" name="gender" value="男性" <?= $row['gender'] == '男性' ? 'checked' : ''; ?>>
                                        男性
                                    </label>
                                    <label class="fontSizeChange">
                                        <input type="radio" name="gender" value="女性" <?= $row['gender'] == '女性' ? 'checked' : ''; ?>>
                                        女性
                                    </label>
                                    <label class="fontSizeChange">
                                        <input type="radio" name="gender" value="その他" <?= $row['gender'] == 'その他' ? 'checked' : ''; ?>>
                                        その他
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>誕生日</th>
                            <td>
                                <input class="width_100percent" type="date" name="birthday" value=<?php echo $row['birthday']; ?> required>
                            </td>
                        <tr>
                            <th>職業</th>
                            <td>
                                <select name="occupation" class="width_100percent arrow">
                                    <option value="高校1年生1" <?= $row['occupation'] == '高校1年生' ? 'selected' : ''; ?>>高校1年生</option>
                                    <option value="高校2年生" <?= $row['occupation'] == '高校2年生' ? 'selected' : ''; ?>>高校2年生</option>
                                    <option value="高校3年生" <?= $row['occupation'] == '高校3年生' ? 'selected' : ''; ?>>高校3年生</option>
                                    <option value="高校4年生" <?= $row['occupation'] == '高校4年生' ? 'selected' : ''; ?>>高校4年生</option>
                                    <option value="予備校生" <?= $row['occupation'] == '予備校生' ? 'selected' : ''; ?>>予備校生</option>
                                    <option value="大学院生" <?= $row['occupation'] == '大学院生' ? 'selected' : ''; ?>>大学院生</option>
                                    <option value="大学生" <?= $row['occupation'] == '大学生' ? 'selected' : ''; ?>>大学生</option>
                                    <option value="短大生" <?= $row['occupation'] == '短大生' ? 'selected' : ''; ?>>短大生</option>
                                    <option value="高専生" <?= $row['occupation'] == '高専生' ? 'selected' : ''; ?>>高専生</option>
                                    <option value="専門学校生" <?= $row['occupation'] == '専門学校生' ? 'selected' : ''; ?>>専門学校生</option>
                                    <option value="中学生" <?= $row['occupation'] == '中学生' ? 'selected' : ''; ?>>中学生</option>
                                    <option value="小学生" <?= $row['occupation'] == '小学生' ? 'selected' : ''; ?>>小学生</option>
                                    <option value="その他の学生" <?= $row['occupation'] == 'その他の学生' ? 'selected' : ''; ?>>その他の学生</option>
                                    <option value="社会人" <?= $row['occupation'] == '社会人' ? 'selected' : ''; ?>>社会人</option>
                                    <option value="留学生" <?= $row['occupation'] == '留学生' ? 'selected' : ''; ?>>留学生</option>
                                    <option value="保護者" <?= $row['occupation'] == '保護者' ? 'selected' : ''; ?>>保護者</option>
                                    <option value="先生" <?= $row['occupation'] == '先生' ? 'selected' : ''; ?>>先生</option>
                                    <option value="高卒認定" <?= $row['occupation'] == '高卒認定' ? 'selected' : ''; ?>>高卒認定</option>
                                    <option value="その他" <?= $row['occupation'] == 'その他' ? 'selected' : ''; ?>>その他</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>出身学校</th>
                            <td><input class="width_100percent" type="text" name="school" value=<?php echo $row['school']?> required></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>
                                <input class="size150" type="text" name="thirdTel" value=<?php echo $row['tel']?> maxlength="11" required>
                            </td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>
                                <input class="width_100percent" type="text" name="address" value=<?php echo $row['address']?> required>

                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><input class="width_100percent" type="email" name="mail" value=<?php echo $row['mail']?> required></td>
                        </tr>
                        <tr>
                            <th>希望学科</th>
                            <td>
                                <select name="cource" class="width_100percent arrow">
                                    <option value="ゲーム学科" <?= $row['course'] == 'ゲーム学科' ? 'selected' : ''; ?>>ゲーム学科</option>
                                    <option value="デザイン学科" <?= $row['course'] == 'デザイン学科' ? 'selected' : ''; ?>>デザイン学科</option>
                                    <option value="情報処理学科" <?= $row['course'] == '情報処理学科' ? 'selected' : ''; ?>>情報処理学科</option>
                                    <option value="その他" <?= $row['course'] == 'その他' ? 'selected' : ''; ?>>その他</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endforeach; ?>
                <button type="submit" class="login-submit">変更</button>
            </form>
        </div>
    </main>
</body>
</html>