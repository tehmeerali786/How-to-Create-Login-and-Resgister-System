<?php

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