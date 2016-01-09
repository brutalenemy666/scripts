<?php
$to      = "your_email@example.com";
$subject = "Testing mail";
$message = "Hello! This is a simple email message.";
$headers = "From: John Doe <john_doe@example.com>";

if ( mail($to,$subject,$message,$headers) ) {
	echo("<p>Message successfully sent!</p>");
} else {
	echo("<p>Message delivery failed.</p>");
	if ( function_exists('mail') ){
		echo '<p>mail() is available.</p>';
	}else{
		echo '<p>mail() has been disabled.</p>';
	}
}
?>
<hr />Source Code: <hr />
<?php highlight_file(__FILE__); ?>
