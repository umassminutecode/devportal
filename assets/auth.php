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



    //Check their password

    $passwordmd5 = md5($password);
    if(get_user_field($uid, "password") == $passwordmd5){
        //Successful Login

        //Collect data and generate key
        //$uid
        $key = md5(rand(0, PHP_INT_MAX));
        $key_creation = time();
        $key_expiration = $key_creation + (15 * 60); //15 Minutes
        $ip = $_SERVER['REMOTE_ADDR'];

        //Store info in session
        $_SESSION['SESS_UID'] = $uid;
        $_SESSION['SESS_KEY'] = $key;

        //Store info in server
        insert_into_table("auth_keys", array("uid", "auth_key", "key_creation", "key_expiration", "ip"), array($uid, $key, $key_creation, $key_expiration, $ip));
        //Redirect to devhome
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


?>
