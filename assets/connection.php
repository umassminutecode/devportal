<?php

	//Database Information
	$servername = "localhost";
	$servusername = "minuteco_dp";
	$servpassword = "8JKspeoLQM8q8O";
	$servdb = "minuteco_devportal";

	//Create connection
	$conn = new mysqli($servername, $servusername, $servpassword);

	//Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	mysqli_select_db($conn, $servdb);
?>