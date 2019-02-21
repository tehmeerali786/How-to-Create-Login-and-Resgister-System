<div class="widget">
					
					<h2>Hello, <?php echo $user_data['first_name']; ?>!</h2>
					<div class="inner">
						<div class="profile" >
							<?php 

							 ;

							if (isset($_FILES['profile']) === true ) {

								if (empty($_FILES['profile']['name']) === true ) {

									echo 'Please choose a file!';
								} else {

									$allowed = array('jpg', 'jpeg', 'gif', 'png');

									$file_name = $_FILES['profile']['name']; // beginner.png
									$file_extn = strtolower(end(explode('.', $file_name)));
									$file_temp = $_FILES['profile']['tmp_name'];


									if ( in_array($file_extn, $allowed) === true ) {

										change_profile_image($session_user_id, $file_temp, $file_extn);


										header('Location: '. $current_file);
										exit();
										
									} else {

										echo 'Incorrect file type. Allowed: ';

										echo implode(', ', $allowed);
									}
									
								}

							}

							if (empty($user_data['profile']) === false ) {

								//'<img src="', $user_data['profile']  ,'" alt="', $user_data['first_name'] ,'\'s Profile Image" >';
							} 


							?>

							<form action="" method="post" enctype="multipart/form-data">
								
							

							<input type='file' name='profile'> <input type="submit">

							</form>
						</div>
						<ul>
							<li>
								<a href="logout.php">Log out</a>
							</li>
							<li>
								<a href="<?php echo $user_data['username']; ?>">Profile</a>
							</li>
							<li>
								<a href="changepassword.php">Change Password</a>
							</li>
							<li>
								<a href="settings.php">Settings</a>
							</li>
						</ul>
						
					</div>
			</div>	