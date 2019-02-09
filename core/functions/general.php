<?php

	function logged_in_direct() {

		if (logged_in() === true) {

			header('Location: index.php');
			exit();
		}

	}

	function protect_page() {

		if (logged_in() === false) {

			header('Location: protected.php');
			exit();
		}
	}

	function array_sanitize(&$item) {

		$item = mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'), $item);
	}

	function sanitize($data) {

		return mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'),$data);

	}

	function output_errors($errors) {

			$output = array();
			foreach($errors as $error) {

				$output[] = '<li>'. $error . '</li>';

			}

			return '<ul> ' . implode('', $output) . '</ul>';

	}

?>