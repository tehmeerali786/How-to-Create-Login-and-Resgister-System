<?php 

include 'core/init.php';

include 'includes/overall/header.php' ;


 ?>

<h1>Home</h1>
<p>Just a template.</p>

<?php

	if (isset($_SESSION['user_id'])) {

		echo 'Logged: in';
	} else {
		echo 'Not Logged in';
	}



 ?>

<?php include 'includes/overall/footer.php' ; ?>