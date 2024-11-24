<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="./style.css">
    <script src="./calendarScript.js" defer></script>
    <title>予約</title>
</head>
<body>
    <script src="../login.js"></script>
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
        <h1>予約ページ</h1>
        <div class="content-container">
            <h3>日付</h3>
            <div class="calendar">
                <div class="header">
                    <!-- 先月 -->
                    <button class="btn prev">
                        <i>≪</i>
                    </button>
                    <!-- 今月 -->
                    <div class="month">11月 2024年</div>
                    <!-- 来月 -->
                    <button class="btn next">
                        <i>≫</i>
                    </button>
                </div>
                <div class="weekdays">
                    <div class="day">日</div>
                    <div class="day">月</div>
                    <div class="day">火</div>
                    <div class="day">水</div>
                    <div class="day">木</div>
                    <div class="day">金</div>
                    <div class="day">土</div>
                </div>
                <div class="days">
                    <!-- jsでの処理 -->
                </div>
            </div>

            <div class="day-info">
                <h3>時間</h3>
                <div>
                    <ul>
                        <li>9:00</li>
                        <li>10:00</li>
                        <li>11:00</li>
                        <li>12:00</li>
                        <li>13:00</li>
                        <li>14:00</li>
                        <li>15:00</li>
                        <li>16:00</li>
                    </ul>
                </div>

                <h3>備考</h3>
                <textarea name="note" id="note" col=30 row=100></textarea>
            </div>
        </div>
    </main>
</body>
</html>