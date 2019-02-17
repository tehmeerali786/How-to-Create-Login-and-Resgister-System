<?php


			function mysqli_result($res,$row=0,$col=0){ 
						    $numrows = mysqli_num_rows($res); 
						    if ($numrows && $row <= ($numrows-1) && $row >=0){
						        mysqli_data_seek($res,$row);
						        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
						        if (isset($resrow[$col])){
						            return $resrow[$col];
						        }
						    }
						    return false;
						}


			function recover($mode, $email) {


					$mode    	= sanitize($mode);
					$email 		= sanitize($email);

					$user_data = user_data(user_id_from_email($email), 'first_name', 'username');

					if ( $mode == 'username' ) {

						// recover username

						email($email, 'Your username', "Hello " . $user_data['first_name']  . ", \n\nYour username is : " . $user_data['username']  . "\n\n-phpacademy");

					} else if ( $mode == password ) {

						// recover password

					}


			}
 


			function update_user($update_data) {

				global $session_user_id;

				$update = array();

				array_walk($update_data, 'array_sanitize');


				foreach ($update_data as $field => $data) {

					$update[] = '`' . $field . '` = \'' . $data . '\'';

				}

				mysqli_query( mysqli_connect('localhost', 'root', '', 'lr')  , "UPDATE `users` SET" . implode(', ', $update) . " WHERE `user_id` = $session_user_id") or die(mysqli_error(mysqli_connect('localhost', 'root', '', 'lr'))) ;

				
				

			}

			function activate($email, $email_code) {

				$email = mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'), $email);
				$email_code = mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'), $email_code);

				

				if(mysqli_result(mysqli_query(mysqli_connect('localhost', 'root', '', 'lr'), "SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0"), 0) == 1) {

					mysqli_query(mysqli_connect('localhost', 'root', '', 'lr'), "UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
					return true;

				} else {

					return false;
				}
			}


			function change_password($user_id, $password) {

				$user_id = (int)$user_id;
				$password = md5($password);

				mysqli_query(mysqli_connect('localhost', 'root', '', 'lr'), 
					"UPDATE `users` SET `password` = '$password' WHERE `user_id` = $user_id");

			}


			function register_user($register_data) {

				array_walk($register_data, 'array_sanitize');

				$register_data['password'] = md5($register_data['password']);
				

				$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
				
				$data = '\'' . implode('\', \'', $register_data) . '\'';

				

				
				

				mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') ,"INSERT INTO `users` ($fields) VALUES ($data)");
				email($register_data['email'], 'Activate your account', "Hello ". $register_data['first_name']. ", \n\nYou need to activate your account, so use link below:\n\nhttp://localhost/lr/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . " \n\n link - PHP academy.");
				

			}


			function user_count() {

				$con = mysqli_connect('localhost', 'root', '', 'lr');

				return mysqli_result(mysqli_query($con, "SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1 "), 0);
			}


		function user_data($user_id) {

			$data = array();
			$user_id = (int)$user_id;

			$func_num_args = func_num_args();
			$func_get_args = func_get_args();

			if ($func_num_args > 1) {

				unset($func_get_args[0]);

				$fields = '`' . implode('`, `', $func_get_args) . '`';

				$query = "SELECT $fields FROM `users` WHERE `user_id` = $user_id";
				$con = mysqli_connect('localhost', 'root', '', 'lr');
		      	$result = mysqli_query($con, $query);

		      	if ( false===$result ) {
 							printf("error: %s\n", mysqli_error($con));
									}

		      
		      	
		      	$data = mysqli_fetch_assoc($result);

				
				return $data;
			}

			

		}


		function logged_in() {
			return (isset($_SESSION['user_id'])) ? true: false;
		}


		function user_exists($username) {

			$username = sanitize($username);

			$query = mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') , "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' ");

			
			return (mysqli_result($query, 0, 0) == 1) ? true: false;

		}

		function email_exists($email) {

			$email = sanitize($email);

			$query = mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') , "SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' ");

			
			return (mysqli_result($query, 0, 0) == 1) ? true: false;

		}


		function user_active($username) {

			$username = sanitize($username);
			

			$query = mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') , "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1 ");

			

			return (mysqli_result($query, 0, 0) == 1) ? true: false;

		}

		function user_id_from_username($username) {

			$username = sanitize($username);
			$query = mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') , "SELECT `user_id` FROM `users` WHERE `username` = '$username' ");
			return mysqli_result($query, 0, 'user_id') ;

		}

		function user_id_from_email($email) {

			$username = sanitize($email);
			$query = mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') , "SELECT `user_id` FROM `users` WHERE `email` = '$email' ");
			return mysqli_result($query, 0, 'user_id') ;

		}

		function login($username, $password) {

			$user_id = user_id_from_username($username);
			

			$username = sanitize($username);
			$password = md5($password);
			
			$query = mysqli_query(mysqli_connect('localhost', 'root', '', 'lr') , "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");

		
			

			return (mysqli_result($query, 0, 0) == 1) ? $user_id : false;
		}




?>