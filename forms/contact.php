<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/php-email-form/PHPMailer/src/PHPMailer.php';
require '../assets/vendor/php-email-form/PHPMailer/src/SMTP.php';
require '../assets/vendor/php-email-form/PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email_from = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'quiland86@gmail.com'; // Ganti
        $mail->Password   = 'mmefvrfqnmchbqai';        // Ganti juga
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email info
        $mail->setFrom($email_from, $name);
        $mail->addAddress('quiland86@gmail.com'); // Bisa diganti tujuan
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Message sent successfully!';
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

