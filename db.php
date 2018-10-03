<?php
	$server = "localhost";
	$database = "parc_db";
	$dbusername = "root";
	$dbpassword = "";

	$con = mysqli_connect($server, $dbusername, $dbpassword, $database);

	# checks connection to database
	# echo mysqli_ping($con) ? 'Connection successful.' : 'Connection failed';
?>