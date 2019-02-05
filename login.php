<?php

	include 'core/init.php' ;
	include 'includes/overall/header.php';

  if (empty($_POST) === false ) {

  	$username = $_POST['username'];
  	$password = $_POST['password'];

  	
	

	

	if (empty($username) === true || empty($password) === true ) {

			$errors[] = 'You need to enter username and password.';

	} else if(user_exists($username) === false) {

		$errors[] = 'We can\'t find that username. Have you registered?';

	} else if (user_active($username, $password) === false) {


		$errors[] = 'We haven\'t activated your account!';
	} else {
         
		 $login = login($username, $password);
		 if ($login === false) {

		 	$errors[] = 'That username/password combination is incorrect';
		 }

		  else {

		 	
		  	
		 	$_SESSION['user_id'] = $login;
		 	header('Location: index.php');
		 	exit();
		 } 
	}

	print_r($errors);

	}


	include 'includes/overall/footer.php';

?>