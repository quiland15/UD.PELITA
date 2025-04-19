<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require '../assets/vendor/php-email-form/PHPMailer/PHPMailer.php';
require '../assets/vendor/php-email-form/PHPMailer/SMTP.php';
require '../assets/vendor/php-email-form/PHPMailer/Exception.php';

// Ganti email penerima di sini
$receiving_email_address = 'quiland86@gmail.com';

$mail = new PHPMailer(true);

try {
  // Konfigurasi SMTP Gmail
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'quiland86@gmail.com'; // Email kamu
  $mail->Password = 'dxmpffyrgybpwhvp';  // App password dari Google
  $mail->SMTPSecure = 'tls';
  $mail->Port = 14167;

  // Data dari form
  $mail->setFrom($_POST['email'], $_POST['name']);
  $mail->addAddress($receiving_email_address);
  $mail->Subject = $_POST['subject'];

  $body = "From: " . $_POST['name'] . "\n";
  $body .= "Email: " . $_POST['email'] . "\n";
  $body .= "Message:\n" . $_POST['message'] . "\n";

  $mail->Body = $body;

  $mail->send();
  echo 'OK'; // Ajax akan membaca ini sebagai sukses

} catch (Exception $e) {
  echo 'ERROR: ' . $mail->ErrorInfo;
}
?>
