<?php

	
	//Database Information
	$servername = "localhost";
	$servusername = "minuteco_webdev";
	$servpassword = "rwLx;(6&XD{m}D}F";
	$servdb = "minuteco_devportal";

	//Create connection
	$conn = new mysqli($servername, $servusername, $servpassword);

	//Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	mysqli_select_db($conn, $servdb);
?>