<?php
session_start();
$results = $_SESSION['results'];
$delte = $_SESSION['delte'];
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
                        <p class="mypage-move"><a href="../mypage/mypage.php" class="red-button">マイページ</a></p>
                    </div>
                <?php else: ?>
                    <h2>参加情報</h2>
                    <div class="participation">
                        <?php if(!empty($delte)){ ?>
                            <dialog open class="deletedialog">
                                <p>削除が完了しました</P>
                                <p class="close-font"><button class="close">閉じる</button></P>
                            </dialog>
                            <script>
                                const deletedialog = document.querySelector('.deletedialog');
                                const close = document.querySelector('.close');
                                //ダイアログを閉じる
                                close.addEventListener('click', () => {
                                    deletedialog.close();
                                });
                            </script>
                        <?php $_SESSION['delte'] = 0;} ?>
                        <h3>参加履歴</h3>
                        <p class="none-participation">・現在参加履歴はありません</p>
                        <p class="mypage-move"><a href="../mypage/mypage.php" class="red-button">マイページ</a></p>
                    </div>
                <?php endif; ?>        
            </div>
        </main>
    </body>
</html>
