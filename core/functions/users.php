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


		function logged_in() {
			return (isset($_SESSION['user_id'])) ? true: false;
		}


		function user_exists($username) {

			$username = sanitize($username);

			$query = mysqli_query( mysqli_connect('localhost', 'root', '', 'lr') , "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' ");

			
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