<?php
	require("connection.php"); //Creats $conn with db connection
	
	
	//Collect session data
	$member_id = $_SESSION['SESS_MEMBER_ID'];
	$key_value_client = $_SESSION['SESS_AUTH_KEY'];
	$expires = $_SESSION['SESS_AUTH_KEY_EXPIRES'];
	
	//Initial check to see if the key is expired and
	//redirect user to login. (Saves server querry's)
	
	if(time() > strtotime($expires)){
		$errmsg_arr[] = "Authentication Expired. Please login again.";
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['ERRMSG_CLR'] = "warning";
		session_write_close();
		header("location: index.php");
		exit();
	}

	
	//Confirm user hasn't been locked
	$query="SELECT * FROM members WHERE id='$member_id'";
	$result = mysqli_query($conn, $query);
	$member = mysqli_fetch_assoc($result);
	if($member["locked"] == true){
		$errmsg_arr[] = "Account Locked. Contact Administrator.";
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['ERRMSG_CLR'] = "danger";
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Check users key
	$query = "SELECT * FROM auth_keys WHERE member_id = '$member_id' ORDER BY id DESC";
	$result = mysqli_query($conn, $query);
	$auth_keys = mysqli_fetch_assoc($result);
	$key_value_server = $auth_keys['key_value'];
	
	//Check server expire time
	if(time() > strtotime($auth_keys['expires'])){
		$errmsg_arr[] = "Authentication Expired. Stop playing with your session time.";
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['ERRMSG_CLR'] = "warning";
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	if($key_value_client == $key_value_server){
		//User is still loged in. Update key times.
		//Check the server vars for key duration
		$query="SELECT * FROM global_vars WHERE var='key_expiration_mins'";
		$result = mysqli_query($conn, $query);
		$global_vars = mysqli_fetch_assoc($result);
		$key_expiration_mins = $global_vars['value'];
		
		$new_expires = date("Y-m-d H:i:s", time()+($key_expiration_mins * 60));
		$query = "UPDATE auth_keys SET expires = '$new_expires' WHERE member_id = '$member_id' AND key_value = '$key_value_server'";
		$result = mysqli_query($conn, $query);
	}else{
		$errmsg_arr[] = "Incorrect Key. Logged Out.";
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['ERRMSG_CLR'] = "danger";
		session_write_close();
		header("location: index.php");
		exit();
	}

?>
