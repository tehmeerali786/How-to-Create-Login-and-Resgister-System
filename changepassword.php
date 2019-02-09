<?php 

include 'core/init.php';

protect_page();

if (empty($_POST) === false) {

	$required_fields = array('current_password', 'password', 'password_again');

	foreach ($_POST as $key=>$value) {

			

		
			
			if (empty($value) && in_array($key, $required_fields) === true ) {

				

				$errors[] = 'Fields marked with an asterik are required.';
				break 1;

				
			} 

			}

				if (md5($_POST['current_password']) === $user_data['password'] ) {

						if (trim($_POST['password']) !== trim($_POST['password_again'])) {


							$errors[] = 'Your new password do not match.';
						}

							else if (strlen($_POST['password']) < 6) {


									$errors[] = 'Your password must be at least 6 characters.';
							}

				

			     				} else {


								$errors[] = 'Your current password is incorrect.';

								} 


					


		
	
}

include 'includes/overall/header.php' ;


 ?>

<h1>Change password.</h1>

<?php

	if () {

		
	}

 ?>

<form action="" method="post">

<ul>
	<li>
		Current password*:<br>
		<input type="text" name="current_password">
	</li>
	<li>
		New password*:<br>
		<input type="text" name="password">
	</li>
	<li>
		New password again*:<br>
		<input type="text" name="password_again">
	</li>
	<li>
		<input type="submit" value="Change password">
	</li>
	
</ul>




</form>




<?php include 'includes/overall/footer.php' ; ?>