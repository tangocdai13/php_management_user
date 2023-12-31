<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (!defined('_INCODE')) die('access denied ...');

function layout($layout = 'header', $data = []) {
    if (file_exists('templates/layouts/login/'.$layout.'.php')) {
        require_once 'templates/layouts/login/'.$layout.'.php';
    }
}

function sendMail($emailTo, $subject, $content) {

//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tangocdai13@gmail.com';                     //SMTP username
        $mail->Password   = 'lyaeawttntzypcnh';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('tangocdai13@gmail.com', 'Mailer');
        $mail->addAddress($emailTo);     //Add a recipient
//        $mail->addAddress('ellen@example.com');               //Name is optional
//        $mail->addReplyTo('info@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        //Attachments
//        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->CharSet = "UTF-8";
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Bạn đã send email thành công';
    } catch (Exception $e) {
        echo "Bạn không thể gửi mail. Mailer Error: {$mail->ErrorInfo}";
    }
}

function isPost() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }

    return false;
}

function isGet() {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }

    return false;
}

function getBody() {
    $bodyArr = [];

    if (isGet()) {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                // Xử lý key
                $key = strip_tags($key);

                // Xử lý value
                if (is_array($value)) {
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    if (isPost()) {
        if(!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                // Xử lý key
                $key = strip_tags($key);

                // Xử lý value
                if (is_array($value)) {
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    return $bodyArr;
}

function isPhone($phone) {
    $firstCharPhone = false;

    $numberPhone = false;

    if ($phone[0] == '0') {
        $firstCharPhone = true;
        $phone = substr($phone, 1);
    }

    if (filter_var($phone, FILTER_VALIDATE_INT) && strlen($phone) == 9) {
        $numberPhone = true;
    }

    if ($firstCharPhone && $numberPhone) {
        return true;
    }

    return false;
}

function getMsg($msg, $msgType)
{
    echo '<div class="alert alert-'.$msgType.' text-center">';
    echo $msg;
    echo '</div>';
}

function redirect($path = 'index.php')
{
    header("Location: $path");
    exit;
}