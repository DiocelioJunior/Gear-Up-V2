<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.sendgrid.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'apikey';
    $mail->Password = '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';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('jdiocelio@gmail.com', 'Your Name');
    $mail->addAddress('jdiocelio@gmail.com', 'Recipient Name');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body = 'This is a test email from PHPMailer. If you received this, the SMTP connection is working.';

    $mail->send();
    echo 'Email enviado com sucesso!';
} catch (Exception $e) {
    echo 'Ocorreu um erro ao enviar o email: ' . $mail->ErrorInfo;
}
?>
