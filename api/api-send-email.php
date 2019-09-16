<?php

$propertyToSend = $_GET['id'];
// $sactivationKey = "RTsdjdkskdhhasl";
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
  //Server settings
  // $mail->SMTPOptions = array(
  //   'ssl' => array(
  //     'verify_peer' => false,
  //     'verify_peer_name' => false,
  //     'allow_self_signed' => true
  //   )
  // );
  $mail->SMTPDebug = 0;                                       // Enable verbose debug output
  $mail->isSMTP();                                            // Set mailer to use SMTP
  $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'wkea108@gmail.com';                     // SMTP username
  $mail->Password   = 'kea787878';                               // SMTP password
  $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('wkea108@gmail.com', 'You saved the property');
  $mail->addAddress('wkea108@gmail.com', 'Penny Lane');     // Add a recipient
  // $mail->addAddress('ellen@example.com');               // Name is optional
  // $mail->addReplyTo('dummy@gmail.com', 'Information');
  // $mail->addCC('cc@example.com');
  // $mail->addBCC('bcc@example.com');

  // Attachments
  // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

  // Content
  $mail->isHTML(true);
  // Set email format to HTML
  // $_SESSION['id'] = "5d78cbcfd30f5";
  // session_start();
  // if (!$_SESSION['id']) {
  //   exit;
  // }
  // $sPath = "http://localhost/activate-email/api-activate-account.php?id=U1&key=$sactivationKey";
  $sPath = 'http://localhost/PennyLane/property.php?id=' . $propertyToSend . '';
  $mail->Subject = 'Your saved properties';
  $mail->Body    = 'You have added this property to your list <a href="' . $sPath . '"> Property # ' . $propertyToSend . ' </a>';
  // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send(); // Send the email
  echo '{"status":1, "message": "Message is sent"}';
} catch (Exception $e) {
  echo '{"status":0, "message": "Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '"}';
}
