<?php

	require("connection.php"); //Creats $conn with db connection
	$query="SELECT * FROM members WHERE id='$member_id'";
	$result = mysqli_query($conn, $query);
	$member = mysqli_fetch_assoc($result);
	
	$name = $member['first-name'];

?>

