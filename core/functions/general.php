<?php
  
    require './phpmailer/PHPMailerAutoload.php';

    
    

    
    

	 function email($to, $subject, $body) {

	 		$mail = new PHPMailer();

	 		$mail->isSMTP();
	 		$mail->Host = "smtp.gmail.com";
	 		$mail->SMTPSecure = "ssl";
	 		$mail->Port = 465;
	 		$mail->SMTPAuth = true;
	 		$mail->Username = 'freelanceali786@gmail.com';
	 		$mail->Password = 'YaProtectorYaMerciful786()';

	 		$mail->setFrom('freelanceali786@gmail.com', 'Tehmeer Ali Paryani');
	 		$mail->addAddress($to);
	 		$mail->Subject = $subject;
	 		$mail->Body = $body;

	 					if ($mail->send()) {
							    echo "Mail sent";

							    
							} else {

								echo 'Message was not sent.';

							    echo 'Mailer error: ' . $mail->ErrorInfo;
							}
	 	

					

		
	} 

	function logged_in_direct() {

		if (logged_in() === true) {

			header('Location: index.php');
			exit();
		}

	}

	function protect_page() {

		if (logged_in() === false) {

			header('Location: protected.php');
			exit();
		}
	}

	function array_sanitize(&$item) {

		$item = htmlentities(strip_tags(mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'), $item)));
	}

	function sanitize($data) {

		return htmlentities( strip_tags(mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'),$data)));

	}

	function output_errors($errors) {

			$output = array();
			foreach($errors as $error) {

				$output[] = '<li>'. $error . '</li>';

			}

			return '<ul> ' . implode('', $output) . '</ul>';

	}

?>