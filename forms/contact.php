<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Tampilkan error biar bisa debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load PHPMailer
require '../assets/vendor/php-email-form/PHPMailer/src/PHPMailer.php';
require '../assets/vendor/php-email-form/PHPMailer/src/SMTP.php';
require '../assets/vendor/php-email-form/PHPMailer/src/Exception.php';

// Ganti email penerima di sini
$receiving_email_address = 'quiland86@gmail.com'; // Email tujuan penerima

$mail = new PHPMailer(true);

try {
  // Konfigurasi SMTP Gmail
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'quiland86@gmail.com'; // Ganti dengan email kamu
  $mail->Password = 'mmefvrfqnmchbqai';  // App password dari Google
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587; // Port SMTP untuk TLS

  // Ambil data dari form (pastikan POST sudah ada)
  $name = htmlspecialchars($_POST['name']); // Sanitasi input
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validasi email
  $subject = htmlspecialchars($_POST['subject']); // Sanitasi input
  $message = nl2br(htmlspecialchars($_POST['message'])); // Sanitasi dan preserve newlines

  if (!$email) {
    throw new Exception('Invalid email address.');
  }

  // Set pengirim & penerima
  $mail->setFrom($email, $name);
  $mail->addAddress($receiving_email_address); // Ganti juga kalau mau kirim ke email lain

  // Isi email
  $mail->Subject = $subject;
  $body = "<b>From:</b> $name ($email)<br><b>Message:</b><br>$message";
  $mail->isHTML(true); // Mengirim email dalam format HTML
  $mail->Body = $body;

  // Kirim email
  $mail->send();
  echo json_encode(['message' => 'Message has been sent successfully!']);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
}
?>
