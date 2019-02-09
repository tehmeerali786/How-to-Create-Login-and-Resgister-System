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


			function register_user($register_data) {

				array_walk($register_data, 'array_sanitize');

				$register_data['password'] = md5($register_data['password']);
				

				$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
				
				$data = '\'' . implode('\', \'', $register_data) . '\'';

				

				
				

				mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') ,"INSERT INTO `users` ($fields) VALUES ($data)");
				

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

		function login($username, $password) {

			$user_id = user_id_from_username($username);
			

			$username = sanitize($username);
			$password = md5($password);
			
			$query = mysqli_query(mysqli_connect('localhost', 'root', '', 'lr') , "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password'");

		
			

			return (mysqli_result($query, 0, 0) == 1) ? $user_id : false;
		}




?>