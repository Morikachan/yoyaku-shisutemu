<?php

//inquiry.htmlの実行後に走る処理です。
//メールの送信を行っています。
$mail = $_POST['inquiryEmail'];
$content  = $_POST['inquiryContent'];

// Setting($mail,$content,$sendto,$maintext,$sendsubject);


// function Setting($mail,$content,$sendto,$maintext,$sendsubject){
//     try {
//         $IMGNAME = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : NULL;
//         $IMGTMP = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : NULL;
//         $fp = @fopen($IMGTMP, "rb");
//         $img = @fread($fp, filesize($IMGTMP));
//         @fclose($fp);
//         $IMGSIZE = floor(strlen($img) / 1024);
//         $ENCODEIMG = base64_encode($img);
//         $imginfo = @getimagesize('data:application/octet-stream;base64,' . $ENCODEIMG);
//         $IMGTYPE = $imginfo['mime'];
//         $BOUNDARY = '__BOUNDARY__' .md5(rand());
//         $to = 'k248007@kccollege.ac.jp';
//         $subject = "{$mail}様からお問い合わせです";
//         $header = implode("\r\n",array(
//             'Content-Type: multipart/mixed;boundary=' . $BOUNDARY ,
//             'From: webmaster@example.com',
//             'Reply-To: webmaster@example.com',
//         ));
//         $body = "--" . $BOUNDARY . "\n";
//         $body .= 'Content-Type: text/plain; charset="ISO-2022-JP' . "\n";
//         $body .= "{$mail}様から。\r\n お問い合わせ内容 \r\n {$content}" . "\n";
//         $body .= '--' . $BOUNDARY . "\n";
//         $body .= 'Content-Type: ' . $IMGTYPE . '; name=' . $IMGNAME . "\n";
//         $body .= 'Content-Disposition: attachment; filename=' . $IMGNAME . "\n";
//         $body .= 'Content-Transfer-Encoding: base64' . "\n";
//         $body .= chunk_split($ENCODEIMG) . "\n";
//         $body .= '--' . $BOUNDARY . '--';
//                 //メールの送信
//         if(mail($to, $subject,$body,$header)) {
//             yourmailSetting($mail,$content);
//         } else {
//             header("Location:http://localhost/yoyaku-shisutemu/inquiry/views/mail_error.html");
//             exit();
//         }
//     } catch (Exception $e) {
//         $ERRMSG = $e->getMessage();
//     }

// }

//メールの設定

function mailSetting($mail,$content){
    try {
        $IMGNAME = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : NULL;
        $IMGTMP = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : NULL;
        $fp = @fopen($IMGTMP, "rb");
        $img = @fread($fp, filesize($IMGTMP));
        @fclose($fp);
        $IMGSIZE = floor(strlen($img) / 1024);
        $ENCODEIMG = base64_encode($img);
        $imginfo = @getimagesize('data:application/octet-stream;base64,' . $ENCODEIMG);
        $IMGTYPE = $imginfo['mime'];
        $BOUNDARY = '__BOUNDARY__' .md5(rand());
        $to = 'k248007@kccollege.ac.jp';
        $subject = "{$mail}様からお問い合わせです";
        $header = implode("\r\n",array(
            'Content-Type: multipart/mixed;boundary=' . $BOUNDARY ,
            'From: webmaster@example.com',
            'Reply-To: webmaster@example.com',
        ));
        $body = "--" . $BOUNDARY . "\n";
        $body .= 'Content-Type: text/plain; charset="ISO-2022-JP' . "\n";
        $body .= "{$mail}様から。\r\n お問い合わせ内容 \r\n {$content}" . "\n";
        $body .= '--' . $BOUNDARY . "\n";
        $body .= 'Content-Type: ' . $IMGTYPE . '; name=' . $IMGNAME . "\n";
        $body .= 'Content-Disposition: attachment; filename=' . $IMGNAME . "\n";
        $body .= 'Content-Transfer-Encoding: base64' . "\n";
        $body .= chunk_split($ENCODEIMG) . "\n";
        $body .= '--' . $BOUNDARY . '--';
                //メールの送信
        if(mail($to, $subject,$body,$header)) {
            yourmailSetting($mail,$content);
        } else {
            header("Location: ./views/mail_error.html");
            exit();
        }
    } catch (Exception $e) {
        $ERRMSG = $e->getMessage();
    }

}
    



    
    function yourmailSetting($mail,$content){
        try {
            $IMGNAME = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : NULL;
            $IMGTMP = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : NULL;
            $fp = @fopen($IMGTMP, "rb");
            $img = @fread($fp, filesize($IMGTMP));
            @fclose($fp);
            $IMGSIZE = floor(strlen($img) / 1024);
            $ENCODEIMG = base64_encode($img);
            $imginfo = @getimagesize('data:application/octet-stream;base64,' . $ENCODEIMG);
            $IMGTYPE = $imginfo['mime'];
            $BOUNDARY = '__BOUNDARY__' .md5(rand());
            $to = $mail;
            $subject = "お問い合わせを受け付けました。";
            $header = implode("\r\n",array(
                'Content-Type: multipart/mixed;boundary=' . $BOUNDARY ,
                'From: webmaster@example.com',
                'Reply-To: webmaster@example.com',
            ));
            $body = "--" . $BOUNDARY . "\n";
            $body .= 'Content-Type: text/plain; charset="ISO-2022-JP' . "\n";
            $body .= "以下の内容でお問い合わせを受け付けました。\r\n お問い合わせ内容 \r\n {$content}\n ご連絡させていただきますので少々お待ちください". "\n";
            $body .= '--' . $BOUNDARY . "\n";
            $body .= 'Content-Type: ' . $IMGTYPE . '; name=' . $IMGNAME . "\n";
            $body .= 'Content-Disposition: attachment; filename=' . $IMGNAME . "\n";
            $body .= 'Content-Transfer-Encoding: base64' . "\n";
            $body .= chunk_split($ENCODEIMG) . "\n";
            $body .= '--' . $BOUNDARY . '--';
                    //メールの送信
            if(mail($to, $subject,$body,$header)) {
                header("Location: ./views/index.html");
                exit();
            } else {
                header("Location: ./views/mail_error.html");
                exit();
            }
        } catch (Exception $e) {
            $ERRMSG = $e->getMessage();
        }
    
    }
    
//ここまでメールの設定
    mailSetting($mail,$content);
?>