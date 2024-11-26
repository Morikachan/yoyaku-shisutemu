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

    <title>登録情報の変更</title>
</head>
<body>
    <header class="c-header c-hamburger-menu"><!-- 追記 クラスを追記 -->
        <a href="https://www.kccollege.ac.jp/" class="c-header__logo"><img src="../../img/image 1.png" alt="Arts_Logo"></a>
        <div class="flex">
            <a href="#" class="red-button">お問い合わせ</a>
        </div>
    </header>
    <main>
        <h1>登録情報の変更</h1>
        <div class="content-container">
            <form action="../backend/change_Information.php" method="post">
                <?php foreach ($results as $row): ?>
                    <?php
                        $name = explode("　",$row['name']);
                        $katakana = explode("　",$row['katakana']);
                        $birthday = explode("/",$row['birthday']);
                    ?>
                    <table border="1">
                        <tr>
                            <th>ユーザーID</th>
                            <td><?php echo $row['id']; ?></td>
                        </tr>
                        <tr>
                            <th>名前</th>
                            <td colspan="2">
                                <input type="text" value=<?php echo $name[0]?> placeholder="性">
                                <input type="text" value=<?php echo $name[1]?> placeholder="名">
                            </td>
                        </tr>
                        <tr>
                            <th>名前(フリガナ)</th>
                            <td>
                                <input type="text" class="nameee" value=<?php echo $katakana[0]?> placeholder="セイ">
                                <input type="text" class="nameee" value=<?php echo $katakana[1]?> placeholder="メイ">
                            </td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td>
                                <p>
                                <label><input type="radio" name="gender" value="男性" <?= $row['gender'] == '男性' ? 'checked' : ''; ?>>男性</label>
                                <label><input type="radio" name="gender" value="女性" <?= $row['gender'] == '女性' ? 'cheaked' : ''; ?>>女性</label>
                                <label><input type="radio" name="gender" value="その他" <?= $row['gender'] == 'その他' ? 'checked' : ''; ?>>その他</label>
                                </p>
                                <!-- <select name="gender">
                                    <option value="男性" <?= $row['gender'] == '男性' ? 'selected' : ''; ?>>男性</option>
                                    <option value="女性" <?= $row['gender'] == '女性' ? 'selected' : ''; ?>>女性</option>
                                    <option value="その他" <?= $row['gender'] == 'その他' ? 'selected' : ''; ?>>その他</option>
                                </select> -->
                            </td>
                        </tr>
                        <tr>
                            <th>誕生日</th>
                            <td>
                                <input type="date" name="birthday" value=<?= htmlspecialchars(str_replace("/","-",$row['birthday'])); ?>>
                            </td>
                        <tr>
                            <th>職業</th>
                            <td>
                                <select name="occupation">
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
                            <td><input type="text" value=<?php echo $row['school']?>></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><input type="text" value=<?php echo $row['tel']?>></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><input type="text" value=<?php echo $row['address']?>></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><input type="email" value=<?php echo $row['mail']?>></td>
                        </tr>
                        <tr>
                            <th>希望学科</th>
                            <td>
                                <select name="cource">
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