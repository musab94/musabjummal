<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true); 
$mail1 = new PHPMailer(true); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name=$_POST["name"];
	$email=$_POST["email"];
	$phone=$_POST['phone'];
	$web=$_POST['web'];
	$description=$_POST["description"];

	$error = array();

	if (empty($_POST["name"])) {
		$error[] = 'Name';
	}

	if (empty($_POST["email"])) {
		$error[] .= 'Email';
	}

	if (empty($_POST["phone"])) {
		$error[] .= 'Phone';
	}

	if (empty($_POST["web"])) {
		$error[] .= 'Web';
	}

	if (empty($_POST["description"])) {
		$error[] .= 'Description';
	}

	if (empty($error)) {
		// $to = 'musabjummal@gmail.com';
		// $subject = 'New Message from Visitor';
		// $message = 'hello';
		// $headers = 'From: musabjummal <no-reply@musabjummal.ml>';
		// $headers .= "MIME-Version: 1.0\r\n";
  //       $headers .= "Content-type: text/html\r\n";
		
		// if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// 	$client_mail = mail($to, $subject, $message, $headers);
		// 	// var_dump($client_mail);
		// 	if ($client_mail) {
		// 		echo "success";
		// 	} else {
		// 		echo "Something Went Wrong. Please Try Again !!";
		// 	}	
		// }
		// else
		// {
		// 	echo "Please Enetr Correct Email Id.";
		// }

		try {
		    //To ME
		    // $mail->SMTPDebug = 2;                              // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'musabjummal@gmail.com';                 // SMTP username
		    $mail->Password = 'Xiaomi@3';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('no-reply@musabjummal.com', 'Musab Website');
		    $mail->addAddress('musabjummal@gmail.com', 'Musab Jummal');
		    $mail->addReplyTo('no-reply@musabjummal.com', 'Musab Website');

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'New Message from Visitor';
		    $mail->Body    = 'Form Details: <br> <b> Name: </b> '.$_POST["name"].'<br> <b>Email: </b> '.$_POST["email"].'<br> <b>Mobile No.: </b> '.$_POST["phone"].'<br> <b>Website: </b> '.$_POST["web"].'<br> <b>Description: </b> '.$_POST["description"].'';

		    // To Visitor
		    $mail1->isSMTP();                                      // Set mailer to use SMTP
		    $mail1->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail1->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail1->Username = 'musabjummal@gmail.com';                 // SMTP username
		    $mail1->Password = 'Xiaomi@3';                           // SMTP password
		    $mail1->SMTPSecure = 'tls';                        // Enable TLS encryption, `ssl` also accepted
		    $mail1->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail1->setFrom('no-reply@musabjummal.com', 'Musab Jummal');
		    $mail1->addAddress($email, $name);
		    $mail1->addReplyTo('no-reply@musabjummal.com', 'Musab Jummal');

		    //Content
		    $mail1->isHTML(true);                                  // Set email format to HTML
		    $mail1->Subject = 'Hello from Musab Jummal';
		    $mail1->Body    = 'Greetings!<br><br>It is great to hear from you. I would like to thank you for taking the time to write to me. I sincerely hope that I can help you in every way possible and build a relationship that goes a long way! I will get in touch with you soon and we can discuss this in detail.<br>Thanks again! Have a good day.<br><br>Musab Jummal';

			if ($mail->send() && $mail1->send()) {
		    	echo "success";
		    } else {
		    	echo "Something Went Wrong. Please Try Again !!";
		    }

		} catch (Exception $e) {
		    // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		    return 0;
		}
	}
	else {
		$errors = implode(", ", $error);
		echo $errors . " is required!";
	}	
}

?>
