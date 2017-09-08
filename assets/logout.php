<?php 

    $ASSETS_FOLDER = "";
    $PAGE_KEY = "";
    $PAGE_TARGET = "";
    $HIDE_HEADER = True;

    require($ASSETS_FOLDER."header.php");

    $login = new bs_form("login", "minutecode.org");
    unset($_SESSION['SESS_UID'], $_SESSION['SESS_KEY']);
    $login->form_kickback("alert-success", "You have been logged out.");


    require($ASSETS_FOLDER."footer.php");

?>
