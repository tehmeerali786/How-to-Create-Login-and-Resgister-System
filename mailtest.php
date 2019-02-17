<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'freelanceali786@gmail.com';
$mail->Password = '123';

$mail->setFrom('freelanceali786@gmail.com', 'Tehmeer Ali Paryani');
$mail->addAddress('ali786467@gmail.com');
$mail->Subject = 'SMTP email test';
$mail->Body = 'this is some body';

if ($mail->send()) {
    echo "Mail sent";

    
} else {

	echo 'Message was not sent.';

    echo 'Mailer error: ' . $mail->ErrorInfo;
}
?>