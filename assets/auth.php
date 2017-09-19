<?php
session_start();
require("dbfunctions.php");
require("bs_form.php");

$login = new bs_form("login", "minutecode.org");

if($login->process_form()){
    
    $login->check_input("username");
    $login->check_input("password");

    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    $uid = get_user_uid_from_username($username);

    if($uid == -1){
        $login->form_kickback("alert-danger", "Invalid Credentails." . $uid);
    }

    //Begin checking info about the user attempting to login
    if(get_user_field($uid, "locked") == True){
        $login->form_kickback("alert-success", "This account has been locked. Please contact the board for more information.");
    }

    if(get_user_field($uid, "deleted") == True){
        $login->form_kickback("alert-success", "This account has been deleted. Please contact the board for more information.");
    }

    //FIXME: Check onboard stage and redirect if needed



    //Check their password

    $passwordmd5 = md5($password);
    if(get_user_field($uid, "password") == $passwordmd5){
        //Successful Login

        //Collect data and generate key
        //$uid
        $key = md5(rand(0, PHP_INT_MAX));
        $ip = $_SERVER['REMOTE_ADDR'];

        //Store info in session
        $_SESSION['SESS_UID'] = $uid;
        $_SESSION['SESS_KEY'] = $key;

        $endTime = strtotime("+15 minutes");
        $expiration = date('Y-m-d H:i:s', $endTime);

        //Store info in server
        insert_into_table("auth_keys", array("uid", "auth_key", "key_creation", "key_expiration", "ip"), array($uid, $key, date('Y-m-d H:i:s'), $expiration, $ip));
        //Redirect to devhome
        if(isset($_SESSION["REQUEST_URL"])){
            header("Location: ".$_SESSION["REQUEST_URL"]);
        }
        header("Location: http://minutecode.org/dev_home.php");
        exit();

    }else{
        //Unsuccessful Login
        update_field("users", "password_attempts", "password_attempts + 1", "uid", $uid);

        if(get_user_field($uid, "password_attempts") == 3){
            update_field("users", "locked", "1", "uid", $uid);
            $login->form_kickback("alert-danger", "Too many failed password attempts. Your account has been locked. Please contact a member of the board for assiastance.");
        }
        $login->form_kickback("alert-warning", "Incorrect password. Please try again.");
    }

}


//check to see if key already exist and is valid

if(isset($_SESSION['SESS_UID']) == False || isset($_SESSION['SESS_KEY']) == False){
    header("Location: http://minutecode.org");
}

//check if they have a valid key

    $uid = $_SESSION['SESS_UID'];
    $key = $_SESSION['SESS_KEY'];

$sql = "SELECT key_expiration
        FROM auth_keys 
        WHERE uid=\"$uid\" AND auth_key=\"$key\"
        ";
$query = query_db($sql);
if($query == False){
    //Key not in db send to login
    unset($_SESSION['SESS_UID'], $_SESSION['SESS_KEY']);
    $login->form_kickback("alert-danger", "Invalid Auth Key.");
    exit();
}
$result = next_result($query);


//FIXME: Not Working
//We are updating key expiration to be now which thankfully is not working  
if(strtotime($result["key_expiration"]) >= strtotime("+1 seconds")){
    //Success -- give user 15 more minutes
    update_timestamp_field("users", "key_expiration", "uid = \"$uid\" AND auth_key", $key);
}else{
    //Key invalid
    unset($_SESSION['SESS_UID'], $_SESSION['SESS_KEY']);
    $login->form_kickback("alert-warning", "Login expired. Please re-login.");
    exit();
}




?>
