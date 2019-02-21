<?php 

include 'core/init.php';

include 'includes/overall/header.php' ;


 ?>

<h1>Home</h1>
<p>Just a template.</p>



<?php 

	if (has_access($session_user_id, 1) === true ) {

		echo 'Admin!';

	} else if (has_access($session_user_id, 2) === true) {

		echo 'Moderator!';
	}


 ?>




<?php include 'includes/overall/footer.php' ; ?>