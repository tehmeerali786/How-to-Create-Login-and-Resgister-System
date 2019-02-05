<?php

	function sanitize($data) {

		return mysqli_real_escape_string(mysqli_connect('localhost', 'root', '', 'lr'),$data);

	}

?>