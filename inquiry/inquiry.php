<?php

//inquiry.htmlの実行後に走る処理です。
//メールの送信を行っています。
$mail = $_POST['inquiryEmail'];
$content  = $_POST['inquiryContent'];
$photo = $_POST['avatar'];



//メールの設定
    function mailSetting($mail,$content,$photo){

        //送信先{管理者のメアドを登録してください}
        $to = 'k248007@kccollege.ac.jp';

        //送信するメールの表題
        $subject = 'お問い合わせメールです。';

        //本文
        
        $message = "{$mail}様から。\r\n お問い合わせ内容 \r\n {$content} \r\n 添付ファイル \r\n {$photo}";

        //送信元{送信者のメアドか管理者のメアドを入れてください}
        //$headers = "From: {$mail}";
        $headers = "From: k248007@kccollege.ac.jp";


        //メールの送信
        if(mail($to, $subject, $message , $headers)) {
            yourmailSetting($mail,$content,$photo);
            header("Location:http://localhost/yoyaku-shisutemu/inquiry/views/index.html");
            exit();

        } else {
            header("Location:http://localhost/yoyaku-shisutemu/inquiry/views/mail_error.html");
            exit();
        }
    }



    
    function yourmailSetting($mail,$content,$photo){

        //送信先{管理者のメアドを登録してください}
        $to = $mail;

        //送信するメールの表題
        $subject = 'お問い合わせを受け付けました。';

        //本文
        
        $message = "{$mail}様\r\nお問い合わせ内容 \r\n {$content} \r\n 添付ファイル \r\n {$photo}\r\n上記の通りお問い合わせを受け付けました。\r\n 後ほどご連絡させて頂きますので少々お待ちください。";

        //送信元{送信者のメアドか管理者のメアドを入れてください}
        //$headers = "From: {$mail}";
        $headers = "From: k248007@kccollege.ac.jp";


        //メールの送信
        if(mail($to, $subject, $message , $headers)) {
            header("Location:http://localhost/yoyaku-shisutemu/inquiry/views/index.html");
            exit();

        } else {
            header("Location:http://localhost/yoyaku-shisutemu/inquiry/views/mail_error.html");
            exit();
        }
    }
//ここまでメールの設定
    mailSetting($mail,$content,$photo);
?>