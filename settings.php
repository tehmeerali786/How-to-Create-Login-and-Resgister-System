<?php 

include 'core/init.php';

protect_page();
include 'includes/overall/header.php' ;


if (empty($_POST) === false) {

		$required_fields = array('first_name', 'email');

			

			foreach ($_POST as $key=>$value) {

			
				
				if (empty($value) && in_array($key, $required_fields) === true ) {

					

					$errors[] = 'Fields marked with an asterik are required.';
					break 1;

					
				} 

			}

			if (empty($errors) === true ) {

				if (filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {

					$errors[] = 'A valid e-mail address is required.';

				} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email'] ) {

					$errors[] = 'Sorry, the mail \'' . $_POST['email'] . '\' is already in use';

				}

			}


			print_r($errors);

}



?>

<h1>Settings</h1>

<form action="" method="post">


	<ul>
		<li>
			First name*:<br>
			<input type="text" name="first_name" value="<?php echo $user_data['first_name'] ?>">
		</li>
		<li>
			Last name:<br>
			<input type="text" name="last_name" value="<?php echo $user_data['last_name'] ?>">
		</li>
		<li>
			Email*:<br>
			<input type="text" name="email" value="<?php echo $user_data['email'] ?>">
		</li>
		<li>
			<input type="submit" value="Update">
		</li>
	</ul>




</form>


<?php
include 'includes/overall/footer.php' ; 

?>