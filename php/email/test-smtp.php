<?php
date_default_timezone_set("Europe/London");
require_once("./class.phpmailer.php");

$to        = 'your_email@example.com';
$from_name = 'John Doe';
$from_mail = 'john_doe@example.com';
$subject   = 'Test subject';
$message   = 'A test message sent via PHPMailer - smtp';


$smtp_domain = 'smtp.domain.com';
$smtp_usr    = 'smtp-usr';
$smtp_pwd    = 'smtp-pwd';

$mail = new PHPMailer(true);                        // New instance, with exceptions enabled
$mail->IsSMTP();                                    // tell the class to use SMTP
$mail->SMTPDebug        = 1;                        // enable the SMTP debug
$mail->SMTPAuth         = true;                     // enable SMTP authentication
$mail->Port             = 25;                       // set the SMTP server port
$mail->Host             = $smtp_domain;             // SMTP server
$mail->Username         = $smtp_usr;                // SMTP server username
$mail->Password         = $smtp_pwd;                // SMTP server password
$mail->From             = $from_mail;
$mail->FromName         = $from_name;
$mail->Subject          = $subject;
$mail->AddAddress($to);
$mail->MsgHTML( $message );

try {
	if ( $mail->Send() ) {
		echo 'Message sent succesfully.';
	} else {
		echo "Couldn't send message: " . $mail->ErrorInfo;
	}

} catch (phpmailerException $e) {
	echo "Couldn't send message: " . $e->errorMessage();
}
?>
<hr />Source Code: <hr />
<?php highlight_file(__FILE__); ?>
