<?php 

include 'core/init.php';
logged_in_direct();
include 'includes/overall/header.php' ;



if (isset($_GET['success']) === true && empty($_GET['success']) === true ) {

	?>

		<h2>Thanks, we've activated your account .... </h2>
		<p>You're free to logged in. </p>



	<?php


}

 else if (isset($_GET['email'], $_GET['email_code']) === true) {


		 	 $email = trim($_GET['email']);
		 	 $email_code = $_GET['email_code'];

		 	 if (email_exists($email) === false) {

		 	 	$errors[] = 'Oops, something went wrong, and we couldn\'t find that e-mail address!' ;

		 	 } else if (activate($email, $email_code) === false) {

		 	 		$errors[] = 'We had problems activating your account.';

		 	 	}


 	 		if(empty($errors) === false) {

 	 			?>


 	 			<h2>Opps .... </h2>



 	 			<?php

 	 			echo output_errors($errors);


 	 		} 

 	 		else {

 	 			header('Location: activate.php?success');

 	 			exit();
 	 		}


		 	

 } else {

 	header('Location: index.php');
 	exit();
 }




 include 'includes/overall/footer.php' ; ?>