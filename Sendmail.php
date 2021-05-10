<?php
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
require_once $_SERVER['DOCUMENT_ROOT'] . "/DBS_Project/PHPMailer/PHPMailerAutoload.php";
function sendMailForReturning($whoborrow, $book, $email)
{
    // include("conn_mysql.php");
    // $inquiry_mail = "SELECT email FROM lablist WHERE name = '".$whoborrow."'";
    // $inquiry_result = mysqli_query($db_link, $inquiry_mail);
    // $email = mysqli_fetch_array($inquiry_result);

    $mail = new PHPMailer(); //建立新物件
    $mail->SMTPDebug = 0;
    $mail->IsSMTP(); //設定使用SMTP方式寄信
    $mail->SMTPAuth = true; //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
    $mail->Port = 465; //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8"; //郵件編碼
    $mail->Username = "shenghsin.chiang@gmail.com"; //Gamil帳號
    $mail->Password = "a14251425"; //Gmail密碼
    $mail->From = "chiangsh@db.cse.nsysu.edu.tw"; //寄件者信箱
    $mail->FromName = "實驗室圖書管理系統"; //寄件者姓名
    $mail->Subject = "提醒還書通知"; //郵件標題
    $mail->Body = "你借閱的書籍: " . $book . "，有人要借閱請盡快歸還。"; //郵件內容
    $mail->IsHTML(false); //郵件內容為html
    $mail->AddAddress($email); //收件者郵件及名稱
    if (!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    } else {
        echo "<div><h3><font color='#008800'><b>Send to ";
        echo $whoborrow;
        echo " / " . $email;
        echo " Completed!</b></font></h3></div>";
    }
}

function sendMailForNewBooks($email, $book)
{
    // include("conn_mysql.php");
    // $inquiry_mail = "SELECT email FROM lablist WHERE name = '".$whoborrow."'";
    // $inquiry_result = mysqli_query($db_link, $inquiry_mail);
    // $email = mysqli_fetch_array($inquiry_result);

    $mail = new PHPMailer(); //建立新物件
    $mail->SMTPDebug = 0;
    $mail->IsSMTP(); //設定使用SMTP方式寄信
    $mail->SMTPAuth = true; //設定SMTP需要驗證
    $mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
    $mail->Port = 465; //Gamil的SMTP主機的埠號(Gmail為465)。
    $mail->CharSet = "utf-8"; //郵件編碼
    $mail->Username = "shenghsin.chiang@gmail.com"; //Gamil帳號
    $mail->Password = "a14251425"; //Gmail密碼
    $mail->From = "a0935999309@gmail.com"; //寄件者信箱
    $mail->FromName = "實驗室圖書管理系統"; //寄件者姓名
    $mail->Subject = "新書通知"; //郵件標題
    $mail->Body = "有新的書籍: " . $book . ""; //郵件內容
    $mail->IsHTML(false); //郵件內容為html
    foreach ($email as $value) {
        $mail->AddAddress($value); //收件者郵件及名稱
    }
    if (!$mail->Send()) {
        echo "Error: " . $mail->ErrorInfo;
    } else {
        echo "<div><h3><font color='#008800'><b>Send to ";
        print_r($email);
        echo " Completed!</b></font></h3></div>";
    }
}