<?php 
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require 'vendor/autoload.php';

	//Create Custom ClassName for Extend PHPMailer Base Class
	class _PHPMailer Extends PHPMailer{ }

	//Create Custom ClassName for Extend SMTP Base Class
	class _SMTP Extends SMTP{ }

	//Create Custom ClassName for Extend Exception Base Class
	class _Exception Extends Exception{ }

	//Usage Example: $mail = new _PHPMailer(true);
	//Usage Example: $mail = new _SMTP();
	//Usage Example: $mail = new _Exception();
?>
