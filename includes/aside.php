<aside id="Just_A_Random_ID">

			<?php 

			if (logged_in() === true) {

				echo 'Logged in';

			}


				else {
					include 'includes/widgets/login.php' ;
				}

				



			?>	
		</aside>