<?php

	include 'core/init.php' ;

	logged_in_direct() ;
	

  if (empty($_POST) === false ) {

  	$username = $_POST['username'];
  	$password = $_POST['password'];

  	
	

	

	if (empty($username) === true || empty($password) === true ) {

			$errors[] = 'You need to enter username and password.';

	} else if(user_exists($username) === false) {

		$errors[] = 'We can\'t find that username. Have you registered?';

	} else if (user_active($username) === false) {


		$errors[] = 'We haven\'t activated your account!';
	} else {
         
         if (strlen($password) > 32) {

		  		$errors[] = 'Password too long';


		  	}

		 $login = login($username, $password);
		 if ($login === false) {

		 	$errors[] = 'That username/password combination is incorrect';
		 }

		  else {

		  	

		 	
		  	
		 	$_SESSION['user_id'] = $login;
		 	header('Location: index.php');
		 	$errors[] ="You are logged in";
		 } 
	}

	

	} else {
		
		$errors[] = 'No data received.';
	}


	include 'includes/overall/header.php';
	if(empty($errors) === false) {

		?>
	
	<h2>We tried to log you in, but .....</h2>
	

	<?php

	   echo output_errors($errors);
	}
	include 'includes/overall/footer.php';

?>