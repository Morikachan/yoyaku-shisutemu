<?php 
    require_once '../core/Database.php';
    
    session_start();
    $UserRegistrationInfo = $_SESSION['UserRegistrationInfo'];

    $courses = [
        "game" => "ゲームクリエイター学科",
        "design" => "デザイン学科",
        "cs" => "情報処理学科"
    ];

    $occupations = [
        "highschool1" => "高校1年生",
        "highschool2" => "高校2年生",
        "highschool3" => "高校3年生",
        "highschool4" => "高校4年生",
        "university" => "大学生",
        "juniorCollege" => "短大生",
        "vocationalSchool" => "専門学校生",
        "adult" => "社会人",
        "internationalStudent" => "留学生",
        "different" => "その他",
    ];    
    function insertStudentData($pdo, $UserRegistrationInfo){
        $sql = "INSERT INTO users_info (mail, passwd, name, katakana, gender, birthday, occupation, school, tel, address, course) 
        VALUES (:mail, :passwd, :name, :katakana, :gender, :birthday, :occupation, :school, :tel, :address, :course)";
        try{
            $smtp = $pdo->prepare($sql);
            $passwordHash = password_hash($UserRegistrationInfo['password'], PASSWORD_DEFAULT);
            $fullName = $UserRegistrationInfo['lastName']." ".$UserRegistrationInfo['firstName'];
            $fullNameKana = $UserRegistrationInfo['lastNameKana']." ".$UserRegistrationInfo['firstNameKana'];
            $address = $UserRegistrationInfo['address1'].$UserRegistrationInfo['address2'];

            $smtp->bindParam(':mail', $UserRegistrationInfo['mail']);
            $smtp->bindParam(':passwd', $passwordHash);
            $smtp->bindParam(':name', $fullName);
            $smtp->bindParam(':katakana', $fullNameKana);
            $smtp->bindParam(':gender', $UserRegistrationInfo['gender']);
            $smtp->bindParam(':birthday', $UserRegistrationInfo['birthday']);
            $smtp->bindParam(':occupation', $UserRegistrationInfo['occupation']);
            $smtp->bindParam(':school', $UserRegistrationInfo['school']);
            $smtp->bindParam(':tel', $UserRegistrationInfo['tel']);
            $smtp->bindParam(':address', $address);
            $smtp->bindParam(':course', $UserRegistrationInfo['course']);
            return $smtp->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pdo = Database::getInstance()->getPDO();
            $result = insertStudentData($pdo, $UserRegistrationInfo);
            // echo $result ? 'true' : 'false';
            $result ? header("Location: ../login.php") : header("Location: ./registration-confirm.php");
    }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./registration_style.css">
    <script src="./modal-window.js"></script>
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
        <h1>新規登録確認</h1>
            <div class="content-container">
                <form action="registration-confirm.php" method="post">
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
                            <p id="course"> <?php echo $courses[$UserRegistrationInfo['course']] ?></p>
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
                            <p id="occupation"> <?php echo $occupations[$UserRegistrationInfo['occupation']]?></p>
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
                        <button type="submit" class="login-submit" id="modalBtn">登録</button>
                        <div id="modal" class="modal">
                            <div class="modal-content">
                              <p>登録できました。ログインしてください</p>
                              <p><a href="../login.php">ログインへ</a></p>
                            </div>
                        </div>
                </form>
            </div>
    </main>
</body>
</html>