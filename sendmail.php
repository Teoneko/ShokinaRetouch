<?php
    use PHPMailer\PHPmailer\PHPmailer;
    use PHPMailer\PHPmailer\Exception;


    require 'phpmailer/Exception.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/PHPmailer.php';


    $mail = new PHPMailer(true);
    $mail -> Charset = 'UTF-8';
    $mail -> setLanguage('ru', 'phpmailer/language/');
    $mail -> IsHTML(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'Mailersendertome@gmail.com'; // Логин на почте
    $mail->Password   = 'ElfenLied147'; // Пароль на почте
    $mail->SMTPSecure = 'auto';
    $mail->Port       = 587;
    $mail->setFrom('Mailersendertome@gmail.com', 'Postman'); // Адрес самой почты и имя отправителя
    //Тема письма
    $mail -> Subject = 'This message from Kate\'s site';
    // Получатель письма
    $mail->addAddress('ruslioncheg@gmail.com'); 
    
    //Тело письма
    $body = '<h1>Ваше супер письмо!</h1>';

    if (trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }
    if (trim(!empty($_POST['mail']))){
        $body.='<p><strong>E-mail:</strong> '.$_POST['mail'].'</p>';
    }
    if (trim(!empty($_POST['subject']))){
        $body.='<p><strong>Тема:</strong> '.$_POST['subject'].'</p>';
    }
    if (trim(!empty($_POST['message']))){
        $body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
    }

    if (!empty($_FILES['image']['tmp_name'])){
        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
        if(copy($_FILES['image']['tmp_name'], $filePath)){
            $fileAttach = $filePath;
            $body.='<p><strong>Фото:</strong></p>';
            $mail -> addAttachment($fileAttach);
        }
    }

    $mail->Body = $body;

    if (!$mail->send()) {
        $message = 'Error';
    } else {
        $message = 'Data sent';
    }

    $response = ['message' => $message];
    array_map('unlink', glob(dirname(__FILE__).'/files/*'));

    header('Content-type: application/json');
    echo json_encode($response);
?>