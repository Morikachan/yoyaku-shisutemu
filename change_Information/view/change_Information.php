<?php
session_start();
// 直接このphpファイルパスを指定された場合、ログイン画面に遷移させる
if(!isset($_SESSION['id']) || empty($_SESSION['id'])){
    header("Location: ../../login.php");
    exit;
}

$id = $_SESSION['id'];
// データベース接続
require_once '../../core/Database.php';
$db = Database::getInstance();
$pdo = $db -> getPDO();

$sql = "SELECT * FROM users_info WHERE id = :id";
try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // パスワードカラムを除外する
    foreach ($results as &$row) {
        unset($row['passwd']);
    }
    
    $_SESSION['results'] = $results;
} catch (PDOException $e) {
    echo $e->getMessage();
    exit();
}

$results = $_SESSION['results'];
var_dump($results);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../login.js"></script>
    <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../backend/jquery.autoKana.js"></script>
    <script type="text/javascript">
        $(function() {
            $.fn.autoKana('input[name="firstName"] ', 'input[name="firstKana"]', {katakana:true});
            $.fn.autoKana('input[name="lastName"] ', 'input[name="lastKana"]', {katakana:true});
        });	
    </script>
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
            <?php if (isset($_SESSION['message'])): ?>
                <div class="info-message">
                    <?php echo htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <form action="../backend/checkData.php" method="post" class="h-adr">
                <?php foreach ($results as $row): ?>
                    <input name="id" type="hidden" value=<?php echo $row['id']?>>
                    <!-- 名前や電話番号を区切って配列に入れています -->
                    <?php
                        $name = explode("　",$row['name']);
                        $katakana = explode("　",$row['katakana']);
                    ?>
                    <table border="0">
                        <tr>
                            <th>名前</th>
                            <td>
                                <input class="nameSpace" name="lastName" type="text" value=<?php echo $name[0]?> placeholder="例）山田" required>
                                <input class="nameSpace" name="firstName" type="text" value=<?php echo $name[1]?> placeholder="例）太郎" required>
                                <input class="nameSpace" name="lastKana" type="text" value=<?php echo $katakana[0]?> placeholder="例）ヤマダ" required>
                                <input class="nameSpace" name="firstKana" type="text" value=<?php echo $katakana[1]?> placeholder="例）タロウ" required>
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
                            <td>
                                <input class="width_100percent" type="text" name="school" value=<?php echo $row['school']?> required>
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>
                                <input type="text" name="tel" value=<?php echo $row['tel']?> maxlength="11" required>
                            </td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>
                                <input type="hidden" class="p-country-name" value="Japan">
                                <p>郵便番号：</p>
                                <input type="text" class="p-postal-code" name="postalcode" value=<?php echo $row['postalcode']?> maxlength="7" required><br>
                                <p>住所</p>
                                <input type="text" id="address" class="p-region p-locality p-street-address p-extended-address" name="address" value=<?php echo $row['address']?> required>
                                <!-- <p>町域名・番地</p>
                                <input type="text" id="address" class="p-street-address p-extended-address" name="address2" value=<?php echo $row['address']?>>
                                <p>建物名 部屋番号</p>
                                <input type="text" id="waddress" name="address3"> -->
                            </td>
                        </tr>
                        
                        <tr>
                            <th>メールアドレス</th>
                            <td>
                                <input class="width_100percent" type="email" name="mail" value=<?php echo $row['mail']?> required>
                            </td>
                        </tr>
                        <tr>
                            <th>希望学科</th>
                            <td>
                                <select name="course" class="width_100percent arrow">
                                    <option value="ゲーム学科" <?= $row['course'] == 'ゲーム学科' ? 'selected' : ''; ?>>ゲーム学科</option>
                                    <option value="デザイン学科" <?= $row['course'] == 'デザイン学科' ? 'selected' : ''; ?>>デザイン学科</option>
                                    <option value="情報処理学科" <?= $row['course'] == '情報処理学科' ? 'selected' : ''; ?>>情報処理学科</option>
                                    <option value="その他" <?= $row['course'] == 'その他' ? 'selected' : ''; ?>>その他</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endforeach; ?>
                <button type="submit" class="login-submit btn-disabled" disabled>変更</button>
            </form>
        </div>
    </main>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");
            const inputs = form.querySelectorAll("input, select, textarea"); // フォーム内すべての入力要素を取得
            const submitButton = form.querySelector(".login-submit");

            // 初期値を保存
            const initialValues = Array.from(inputs).map(input => {
                if (input.type === "radio") {
                    // ラジオボタンは選択されている値を保存
                    const radioGroup = form.querySelectorAll(`input[name="${input.name}"]`);
                    return Array.from(radioGroup).find(radio => radio.checked)?.value || "";
                }
                return input.value;
            });

            // 入力値が変更されたかどうかを確認する関数
            function checkForChanges() {
                let hasChanges = false;
                inputs.forEach((input, index) => {
                    if (input.type === "radio") {
                        // ラジオボタンは選択されている値をチェック
                        const radioGroup = form.querySelectorAll(`input[name="${input.name}"]`);
                        const selectedValue = Array.from(radioGroup).find(radio => radio.checked)?.value || "";
                        if (selectedValue !== initialValues[index]) {
                            hasChanges = true;
                        }
                    } else {
                        // その他の要素は値を直接比較
                        if (input.value !== initialValues[index]) {
                            hasChanges = true;
                        }
                    }
                });

                // クラスと状態の切り替え
                if (hasChanges) {
                    submitButton.disabled = false;
                    submitButton.classList.remove("btn-disabled");
                    submitButton.classList.add("btn-enabled");
                } else {
                    submitButton.disabled = true;
                    submitButton.classList.remove("btn-enabled");
                    submitButton.classList.add("btn-disabled");
                }
            }

            // 入力要素の変更を監視
            inputs.forEach(input => {
                input.addEventListener("input", checkForChanges);
                input.addEventListener("change", checkForChanges); // ラジオボタンやセレクトボックスに対応
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const inputs = document.querySelectorAll("input[required], select[required]");

            inputs.forEach(input => {
                // フォーカスが外れた時の処理
                input.addEventListener("blur", function () {
                    const container = input.parentNode; // 親要素
                    let errorMessage = container.querySelector(".error-text");

                    // 既存のエラーメッセージがある場合は削除
                    if (errorMessage) {
                        errorMessage.remove();
                    }

                    // 入力が空の場合のみエラーメッセージを表示
                    if (!input.value.trim()) {
                        const error = document.createElement("div");
                        error.className = "error-text";
                        error.style.color = "red";
                        error.style.fontSize = "0.9em";

                        // 関連するthタグまたはpタグの内容を取得
                        const th = input.closest("tr")?.querySelector("th");
                        const p = input.previousElementSibling?.tagName === "P" ? input.previousElementSibling : null;

                        const fieldName = th ? th.innerText : (p ? p.innerText.replace('：', '') : "この項目");

                        error.innerText = `${fieldName} を入力してください。`;
                        container.appendChild(error);
                    }
                });

                // 入力が行われた時の処理（エラーメッセージ削除）
                input.addEventListener("input", function () {
                    const container = input.parentNode;
                    let errorMessage = container.querySelector(".error-text");

                    if (errorMessage) {
                        errorMessage.remove();
                    }
                });
            });
        });
    </script>
</body>
</html>