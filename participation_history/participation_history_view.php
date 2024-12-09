<?php
session_start();
$results = $_SESSION['results'];
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./reservation_history.css">
        <title>参加履歴</title>
    </head>
    <body>
    <script src="./hamburger.js"></script>
        <header>
            <div class="header-wrap">
                <img src="../img/image 1.png" alt="Arts_Logo">
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
            <p class="locatoin"><a href="">ホームページ</a>へ/<a href="../mypage/mypage.php">マイページ</a>へ/参加履歴</p>
            <h1>参加履歴</h1>
            <div class="content-container">
                <?php if($results): ?>
                    <h2>参加情報</h2>
                    <div class="participation">
                        <h3>・参加履歴</h3>
                        <p class="delete-history"><button class="openDialog">・<span>履歴をリセット</span>する</button></p>
                        <dialog class="dialogDemo">
                            <p>本当に削除しますか？</P>
                            <div class="chose">
                                <button class="yes">はい</button>
                                <button class="no">キャンセル</button>
                            </div>
                        </dialog>
                        <script>
                            const openBtn = document.querySelector('.openDialog');
                            const dialogDemo = document.querySelector('.dialogDemo');
                            const yes = document.querySelector('.yes');
                            const no = document.querySelector('.no');
                            //ダイアログを開く
                            openBtn.addEventListener('click', () => {
                                dialogDemo.showModal();
                            });
                            //ダイアログを閉じる
                            no.addEventListener('click', () => {
                                dialogDemo.close();
                            });
                            //移動する
                            yes.addEventListener('click', () => {
                                location.href = './delete_history.php';
                            });
                        </script>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>参加日</th>
                                    <th>参加日時</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1;foreach ($results as $row):?>
                                <tr>
                                    <th><?php echo $counter; ?></th>
                                    <th><?php echo $row['day']; ?></th>
                                    <th><?php echo $row['time']; ?>時～</th>
                                </tr>
                            <?php $counter++; endforeach; ?>
                            </tbody>
                        </table>
                        <diV class="button">
                            <p><a href="" class="red-button">予約登録</a></p>
                            <p><a href="../mypage/mypage.php" class="red-button">マイページ</a></p>
                        </div>
                    </div>
                <?php else: ?>
                    <h2>参加情報</h2>
                    <div class="participation">
                        
                        <h3>参加履歴</h3>
                        <p class="none-participation">・現在参加履歴はありません</p>
                        <diV class="button">
                            <p><a href="" class="red-button">予約登録</a></p>
                            <p><a href="../mypage/mypage.php" class="red-button">マイページ</a></p>
                        </div>
                    </div>
                <?php endif; ?>        
            </div>
        </main>
    </body>
</html>
