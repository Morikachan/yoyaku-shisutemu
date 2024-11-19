<?php

//inquiry.htmlの実行後に走る処理です。
//メールの送信を行っています。
$mail = $_POST['inquiryEmail'];
$content  = $_POST['inquiryContent'];



//メールの設定
    function mailSetting($mail,$content){

        //送信先{管理者のメアドを登録してください}
        $to = 'k248007@kccollege.ac.jp';

        //送信するメールの表題
        $subject = 'お問い合わせメールです。';

        //本文
        
        $message = "{$mail}様から。\r\n お問い合わせ内容\r\n{$content}";

        //送信元{送信者のメアドか管理者のメアドを入れてください}
        //$headers = "From: {$mail}";
        $headers = "From: k248007@kccollege.ac.jp";


        //メールの送信
        if(mail($to, $subject, $message , $headers)) {
            echo 'メール送信が成功しました。';
            header("Location:http://localhost/yoyaku-shisutemu/inquiry/views/index.html");
            exit();

        } else {
            echo 'メール送信に失敗しました。';
        }
    }
//ここまでメールの設定
    mailSetting($mail,$content)
?>