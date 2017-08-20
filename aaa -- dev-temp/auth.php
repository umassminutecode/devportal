<?php
	//include("functions.php"); //Misc functions
	require("connection.php"); //Creats $conn with db connection
	session_start(); //Start the session to save user data
	$errmsg_arr = array(); //Array for sending error messages back to login
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	
	//Input Validation
	if($username == ""){
		$errmsg_arr[] = "Username missing";
	}
	if($password == ""){
		$errmsg_arr[] = "Password missing";
	}
	
	//Direct user with errmsg back to login form
	if(!empty($errmsg_arr)){
		$_SESSION["ERRMSG_ARR"] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	//Generate md5 password
	//$passwordmd5 = md5($password)
	$passwordmd5 = $password;
	
	$query="SELECT * FROM members WHERE username='$username'";
	$result = mysqli_query($conn, $query);
	if($result && mysqli_num_rows($result) > 0){
				
		$member = mysqli_fetch_assoc($result);
		if($member["locked"] == true){
			$errmsg_arr[] = "Account Locked. Contact Administrator.";
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			$_SESSION['ERRMSG_CLR'] = "danger";
			session_write_close();
			header("location: index.php");
			exit();
		}
		
		if($member["deleted"] == true){
			$errmsg_arr[] = "Account Deleted. Contact Administrator.";
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			$_SESSION['ERRMSG_CLR'] = "danger";
			session_write_close();
			header("location: index.php");
			exit();
		}
		
		if($member["password"] == $passwordmd5){
			//Check the server vars for key duration
			$query="SELECT * FROM global_vars WHERE var='key_expiration_mins'";
			$result = mysqli_query($conn, $query);
			$global_vars = mysqli_fetch_assoc($result);
			$key_expiration_mins = $global_vars['value'];
			
			//Begin collecting all the information needed for the keys table
			$member_id = $member["id"];
			$key = rand(0, PHP_INT_MAX);
			$issued = date("Y-m-d H:i:s", time());
			$expires = date("Y-m-d H:i:s", time()+($key_expiration_mins * 60));
			$ip4 = $_SERVER['REMOTE_ADDR'];
			$browser = getBrowser($_SERVER['HTTP_USER_AGENT']);
			$os = getOS($_SERVER['HTTP_USER_AGENT']);
			
			//Update key and members table with the login data
			$query = "INSERT INTO auth_keys (member_id, key_value, issued, expires, ip4_addr, browser, os) VALUES ('$member_id', '$key', '$issued', '$expires', '$ip4', '$browser', '$os')";
			$result = mysqli_query($conn, $query);
			$query = "SELECT * FROM auth_keys WHERE member_id = '$member_id' ORDER BY id DESC";
			$result = mysqli_query($conn, $query);
			$auth_keys = mysqli_fetch_assoc($result);
			$key_id = $auth_keys['id'];
			$query = "UPDATE members SET last_login = '$issued', last_login_ip = '$ip4', key_id = '$key_id', failed_login_attempts = '0' WHERE id = '$member_id	'";
			$result = mysqli_query($conn, $query);
			
			$_SESSION['SESS_MEMBER_ID'] = $member_id;
			$_SESSION['SESS_AUTH_KEY'] = $key;
			$_SESSION['SESS_AUTH_KEY_EXPIRES'] = $expires;
			session_write_close();
			header("location: devhome.php");
			exit();
		}else{
			//Wrong Password -- Start with checking failed attempts
			$query="SELECT * FROM members WHERE username='$username'";
			$result = mysqli_query($conn, $query);
			$member = mysqli_fetch_assoc($result);
			$failed_login_attempts = $member['failed_login_attempts'];
			
			if($failed_login_attempts == 2){
				//User has already failed twice making this the 3rd failed attemp.
				$query = "UPDATE members SET locked = '1', failed_login_attempts = '3' WHERE username = '$username'";
				$result = mysqli_query($conn, $query);
				$errmsg_arr[] = "3rd incorrect password. Account locked";
				$errmsg_arr[] = "Contact administrator for account recovery";
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				$_SESSION['ERRMSG_CLR'] = "danger";
				session_write_close();
				header("location: index.php");
				exit();
			}
			//Update number of failed attempts
			$failed_login_attempts = $failed_login_attempts + 1;
			$query = "UPDATE members SET failed_login_attempts = '$failed_login_attempts' WHERE username = '$username'";
			$result = mysqli_query($conn, $query);
			
			$errmsg_arr[] = "Incorect Password.";
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
			$_SESSION['ERRMSG_CLR'] = "danger";
			session_write_close();
			header("location: index.php");
			exit();
		}
		
	}else{
		//Login failed -- Not due to incorrect password that is handled above
		$errmsg_arr[] = "Internal Server Error. Contact Administrator.";
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		$_SESSION['ERRMSG_CLR'] = "danger";
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	function getOS($user_agent) { 

		global $user_agent;

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
								'/windows nt 10/i'     =>  'Windows 10',
								'/windows nt 6.3/i'     =>  'Windows 8.1',
								'/windows nt 6.2/i'     =>  'Windows 8',
								'/windows nt 6.1/i'     =>  'Windows 7',
								'/windows nt 6.0/i'     =>  'Windows Vista',
								'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
								'/windows nt 5.1/i'     =>  'Windows XP',
								'/windows xp/i'         =>  'Windows XP',
								'/windows nt 5.0/i'     =>  'Windows 2000',
								'/windows me/i'         =>  'Windows ME',
								'/win98/i'              =>  'Windows 98',
								'/win95/i'              =>  'Windows 95',
								'/win16/i'              =>  'Windows 3.11',
								'/macintosh|mac os x/i' =>  'Mac OS X',
								'/mac_powerpc/i'        =>  'Mac OS 9',
								'/linux/i'              =>  'Linux',
								'/ubuntu/i'             =>  'Ubuntu',
								'/iphone/i'             =>  'iPhone',
								'/ipod/i'               =>  'iPod',
								'/ipad/i'               =>  'iPad',
								'/android/i'            =>  'Android',
								'/blackberry/i'         =>  'BlackBerry',
								'/webos/i'              =>  'Mobile'
							);

		foreach ($os_array as $regex => $value) { 

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}   

		return $os_platform;

	}

	function getBrowser($user_agent) {

		global $user_agent;

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
								'/msie/i'       =>  'Internet Explorer',
								'/firefox/i'    =>  'Firefox',
								'/safari/i'     =>  'Safari',
								'/chrome/i'     =>  'Chrome',
								'/edge/i'       =>  'Edge',
								'/opera/i'      =>  'Opera',
								'/netscape/i'   =>  'Netscape',
								'/maxthon/i'    =>  'Maxthon',
								'/konqueror/i'  =>  'Konqueror',
								'/mobile/i'     =>  'Handheld Browser'
							);

		foreach ($browser_array as $regex => $value) { 

			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}

		}

		return $browser;

	}
	
?>	