<?php 

    ##########################
    # TEMPLATE FOR NEW PAGES #
    # REFRENCES HEADER.PHP   #
    #         + FOOTER.PHP   #
    #                        #
    # MAKE SURE TO UPDATE    #
    # THE ASSETS REFRENCE    #
    ##########################

    $ASSETS_FOLDER = "../assets/";
    $PAGE_KEY = "";
    $PAGE_TARGET = "";

    require($ASSETS_FOLDER."header.php");

    $change_password = new bs_form("change_password", "minutecode.org/self/change_password.php");
    if($change_password->process_form()){

        $change_password->check_input("old_pswd");
        $change_password->check_input("new_pswd");
        $change_password->check_input("new_pswdc");

        if($_POST["new_pswd"] != $_POST["new_pswdc"]){
            $change_password->form_kickback("alert-danger", "Passwords do not match.");
        }

        $passwordmd5 = md5($_POST["old_pswd"]);
        if(get_user_field($GLOBAL_UID, "password") == $passwordmd5){
            //Old password was correct
            //We know from previous checks that passwords are the same

            $newpswdmd5 = md5($_POST["new_pswd"]);

            update_field("users", "password", $newpswdmd5, "uid", $GLOBAL_UID);

            $change_password->form_kickback("alert-success", "Password succesfully changed.");
        }

        $change_password->form_kickback("alert-danger", "Incorrect password.");
        
    }

    //TODO: EVentually add pswd requriements
    $change_password->start_form("post", "form-horizontal", "Change Password");
        $change_password->add_input("password", "Old Password: ", "old_pswd", "", False);
        $change_password->add_input("password", "New Password:", "new_pswd", "", False);
        $change_password->add_input("password", "Confirm  Password:", "new_pswdc", "", False);
    $change_password->end_form();

    require($ASSETS_FOLDER."footer.php");

?>
