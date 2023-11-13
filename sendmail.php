<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

$mail->setFrom('info@info.ru', 'От кого письмо');
$mail->addAddress('assistjob@list.ru');
$mail->Subject = 'тема письма';

$body = '<h1>Сообщение по вопросу трудоуствройства</h1>';
if (trim(!empty($_POST['name']))) {
	$body.= '<p><strong>ИМЯ:</strong> '.$_POST['name'].'</p>';
}
if (trim(!empty($_POST['email']))) {
	$body.= '<p><strong>Email:</strong> '.$_POST['email'].'</p>';
}
if (trim(!empty($_POST['message']))) {
	$body.= '<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
}

$mail->Body = $body;

if (!$mail->send()) {
	$message = 'Ошибка';
} else {
	$message = 'Письмо отправлено';
}
$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);

?>