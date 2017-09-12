<?php

###############################
# Loaded on top of every page #
# Contains the bootstrap refs #
###############################

session_start();
ob_start();

global $IGNORE_AUTH;

if($IGNORE_AUTH){
    require("dbfunctions.php");
    require("bs_form.php");
}else{
    require("auth.php");
}


//Check user auth and store user info

$GLOBAL_UID = $_SESSION['SESS_UID'];

//Redirect user if they go to a page they shouldn't be on
global $ASSETS_FOLDER;
global $PAGE_KEY;
global $PAGE_TARGET;
global $HIDE_HEADER;

if($PAGE_KEY != "")
    show_page($PAGE_KEY, $PAGE_TARGET);


?>

<!DOCTYPE html>
<html>

<?php
#############################
# GLOBAL HEAD FOR ALL PAGES #
#############################
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devportal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/navbar.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/form-gen.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/devportal.css">

    <!-- Data Tables Loading -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

</head>

<?php
#############################
# GLOBAL HEAD FOR ALL PAGES #
#############################
?>







<?php
#################
# GLOBAL NAVBAR #
#################

if($HIDE_HEADER == False)
    require("global_header.php");

echo $_SESSION["dev-msg"];
unset($_SESSION["dev-msg"]);

#################
# GLOBAL NAVBAR #
#################
?>

</html>