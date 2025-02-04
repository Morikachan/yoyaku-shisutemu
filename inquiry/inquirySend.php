<?php

//inquiry.phpの実行後に走る処理です。
//メールの送信を行っています。
$mail = $_POST['inquiryEmail'];
$content  = $_POST['inquiryContent'];

//管理者側のメール
$sendto = 'atrsteamcipsup24@gmail.com';    //宛先
$sendsubject = "{$mail}様からお問い合わせです"; //件名
$maintext = "{$mail}様から。\r\n お問い合わせ内容 \r\n {$content}" . "\n";  //メッセージ


//利用者側のメール
$sendto2 = $mail; 
$sendsubject2 = "お問い合わせを受け付けました";
$maintext2 = "以下の内容でお問い合わせを受け付けました。\r\n お問い合わせ内容 \r\n {$content}\n 担当者が確認次第ご連絡させていただきますので少々お待ちください". "\n";

$BOUNDARY = '__BOUNDARY__' .md5(rand());


$header = meilheader($BOUNDARY);
$body = mailbody($mail,$content,$maintext,$BOUNDARY);




if(mail($sendto, $sendsubject,$body,$header)) {

    $body = mailbody($mail,$content,$maintext2,$BOUNDARY);

    if(mail($sendto2, $sendsubject2,$body,$header)){
        header("Location: ./views/index.php");
        exit();   
    } else{
        header("Location: ./views/mail_error.php");
        exit(); 
    }


} else {
    header("Location: ./views/mail_error.php");
    exit();
}


// function SettingBOUNDARY(){
//     return '__BOUNDARY__' .md5(rand());
// }

function mailbody($mail,$content,$maintext,$BOUNDARY){
   if($IMGTMP = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : NULL){

        $body = imgbody($mail,$content,$maintext,$BOUNDARY);

   } else {

        $body = textbody($mail,$content,$maintext);

   }

   return $body;

}


function textbody($mail,$content,$maintext){
    $body = $maintext;
    return $body;
}
function imgbody($mail,$content,$maintext,$BOUNDARY){
    $IMGNAME = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : NULL;
    $IMGTMP = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : NULL;
    $fp = @fopen($IMGTMP, "rb");
    $img = @fread($fp, filesize($IMGTMP));
    @fclose($fp);
    $IMGSIZE = floor(strlen($img) / 1024);
    $ENCODEIMG = base64_encode($img);
    $imginfo = @getimagesize('data:application/octet-stream;base64,' . $ENCODEIMG);
    $IMGTYPE = $imginfo['mime'];


    // $BOUNDARY = '__BOUNDARY__' .md5(rand());
    $body = "--" . $BOUNDARY . "\n";
    $body .= 'Content-Type: text/plain; charset="ISO-2022-JP' . "\n";

    //差分３
    $body .= $maintext;

    $body .= '--' . $BOUNDARY . "\n";
    $body .= 'Content-Type: ' . $IMGTYPE . '; name=' . $IMGNAME . "\n";
    $body .= 'Content-Disposition: attachment; filename=' . $IMGNAME . "\n";
    $body .= 'Content-Transfer-Encoding: base64' . "\n";
    $body .= chunk_split($ENCODEIMG) . "\n";
    $body .= '--' . $BOUNDARY . '--';
    return $body;
}


function meilheader($BOUNDARY){
    $header = implode("\r\n",array(
    'Content-Type: multipart/mixed;boundary=' . $BOUNDARY ,
    'From: webmaster@example.com',
    'Reply-To: webmaster@example.com',
    ));
    return $header;
}
        

//メールの設定 最適化前、動作確認済み
// function mailSetting($mail,$content){
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
//             header("Location: ./views/mail_error.html");
//             exit();
//         }
//     } catch (Exception $e) {
//         $ERRMSG = $e->getMessage();
//     }

// }
    



    
//     function yourmailSetting($mail,$content){
//         try {
//             $IMGNAME = isset($_FILES['avatar']['name']) ? $_FILES['avatar']['name'] : NULL;
//             $IMGTMP = isset($_FILES['avatar']['tmp_name']) ? $_FILES['avatar']['tmp_name'] : NULL;
//             $fp = @fopen($IMGTMP, "rb");
//             $img = @fread($fp, filesize($IMGTMP));
//             @fclose($fp);
//             $IMGSIZE = floor(strlen($img) / 1024);
//             $ENCODEIMG = base64_encode($img);
//             $imginfo = @getimagesize('data:application/octet-stream;base64,' . $ENCODEIMG);
//             $IMGTYPE = $imginfo['mime'];
//             $BOUNDARY = '__BOUNDARY__' .md5(rand());
//             $to = $mail;
//             $subject = "お問い合わせを受け付けました。";
//             $header = implode("\r\n",array(
//                 'Content-Type: multipart/mixed;boundary=' . $BOUNDARY ,
//                 'From: webmaster@example.com',
//                 'Reply-To: webmaster@example.com',
//             ));
//             $body = "--" . $BOUNDARY . "\n";
//             $body .= 'Content-Type: text/plain; charset="ISO-2022-JP' . "\n";
//             $body .= "以下の内容でお問い合わせを受け付けました。\r\n お問い合わせ内容 \r\n {$content}\n 担当者が確認次第ご連絡させていただきますので少々お待ちください". "\n";
//             $body .= '--' . $BOUNDARY . "\n";
//             $body .= 'Content-Type: ' . $IMGTYPE . '; name=' . $IMGNAME . "\n";
//             $body .= 'Content-Disposition: attachment; filename=' . $IMGNAME . "\n";
//             $body .= 'Content-Transfer-Encoding: base64' . "\n";
//             $body .= chunk_split($ENCODEIMG) . "\n";
//             $body .= '--' . $BOUNDARY . '--';
//                     //メールの送信
//             if(mail($to, $subject,$body,$header)) {
//                 header("Location: ./views/index.html");
//                 exit();
//             } else {
//                 header("Location: ./views/mail_error.html");
//                 exit();
//             }
//         } catch (Exception $e) {
//             $ERRMSG = $e->getMessage();
//         }
    
//     }
    
// //ここまでメールの設定
//     mailSetting($mail,$content);
?>