<?php 

    ##########################
    # TEMPLATE FOR NEW PAGES #
    # REFRENCES HEADER.PHP   #
    #         + FOOTER.PHP   #
    #                        #
    # MAKE SURE TO UPDATE    #
    # THE ASSETS REFRENCE    #
    ##########################

    $ASSETS_FOLDER = "assets/";
    $PAGE_KEY = "";
    $PAGE_TARGET = "";
    $HIDE_HEADER = True;

    require($ASSETS_FOLDER."header.php");

    //Need to get
    $ONBOARD_UID = filter_var($_GET["uid"], FILTER_SANITIZE_STRING);
    $stage = get_user_info($ONBOARD_UID, "onboard_stage");
    $username = get_user_username($ONBOARD_UID);
?>


<div class="container-fluid">

    <div class="row <?php if($stage != 0) echo "hidden"; ?>">
        <?php
        #### STAGE 0 ####

        $onboard_0 = new bs_form("onboard_0", "minutecode.org/onboard_user.php?uid=$ONBOARD_UID");

        if($onboard_0->process_form()){
            
            $onboard_0->check_input("username");
            $onboard_0->check_input("code");

            $sql = "SELECT * 
            FROM `user_info` 
            WHERE `uid`=\"$ONBOARD_UID\" AND `email_code`=\"" . $_POST["code"] . "\" ";

            if(num_rows($sql) == 1){
                update_field("user_info", "onboard_stage", "1", "uid", $ONBOARD_UID);
            }else{
                $onboard_0->form_kickback("alert-danger", "Wrong code. Please check your email and retry.");
            }
            

            $onboard_0->form_kickback("", "");
        }

        $onboard_0->start_form("post", "form-horizontal", "Onboarding", -1);
            $onboard_0->add_text("Welcome to the minutecode onboarding process. This should only take a few minutes to complete...");
            $onboard_0->add_input("text", "Username: ", "username", "$username", False, True);
            $onboard_0->add_input("text", "Email Code:", "code", "");
        $onboard_0->end_form();

        ?>
    </div>

    <div class="row <?php if($stage != 1) echo "hidden"; ?>">
        <?php
        #### STAGE 1 ####

        $onboard_1 = new bs_form("onboard_1", "minutecode.org/onboard_user.php?uid=$ONBOARD_UID");
        
            if($onboard_1->process_form()){
                
            $onboard_1->check_input("fname");
            $onboard_1->check_input("lname");
            $onboard_1->check_input("pemail");
            $onboard_1->check_input("tel");
    
            update_field("user_info", "fname", $_POST["fname"], "uid", $ONBOARD_UID);
            update_field("user_info", "lname", $_POST["lname"], "uid", $ONBOARD_UID);
            update_field("user_info", "pemail", $_POST["pemail"], "uid", $ONBOARD_UID);
            update_field("user_info", "tel", $_POST["tel"], "uid", $ONBOARD_UID);

            update_field("user_info", "onboard_stage", "2", "uid", $ONBOARD_UID);

            $onboard_1->form_kickback("", "");
        }

        $onboard_1->start_form("post", "form-horizontal", "Basic Info", 0);
            $onboard_1->add_input("text", "First Name: ", "fname", "", False);
            $onboard_1->add_input("text", "Last Name: ", "lname", "", False);
            $onboard_1->add_input("email", "Personal Email: ", "pemail", "", False);
            $onboard_1->add_input("tel", "Phone Number: ", "tel", "", False);
        $onboard_1->end_form();

        ?>
    </div>

    <div class="row <?php if($stage != 2) echo "hidden"; ?>">
        <?php
        #### STAGE 2 ####

        $onboard_2 = new bs_form("onboard_2", "minutecode.org/onboard_user.php?uid=$ONBOARD_UID");
        
        if($onboard_2->process_form()){
            
            $onboard_2->check_input("eyear");
            $onboard_2->check_input("yog");
            $onboard_2->check_input("college");
            $onboard_2->check_input("major");
    
            update_field("user_info", "eyear", $_POST["eyear"], "uid", $ONBOARD_UID);
            update_field("user_info", "yog", $_POST["yog"], "uid", $ONBOARD_UID);
            update_field("user_info", "college", $_POST["college"], "uid", $ONBOARD_UID);
            update_field("user_info", "major", $_POST["major"], "uid", $ONBOARD_UID);
            update_field("user_info", "minor", $_POST["minor"], "uid", $ONBOARD_UID);
            update_field("user_info", "cert", $_POST["cert"], "uid", $ONBOARD_UID);

            update_field("user_info", "onboard_stage", "3", "uid", $ONBOARD_UID);

            $onboard_2->form_kickback("", "");
        }

        $onboard_2->start_form("post", "form-horizontal", "Academic Info", 25);
            $onboard_2->add_input("month", "Enrollment: ", "eyear", "", False);
            $onboard_2->add_input("month", "Graduation: ", "yog", "", False);
            $onboard_2->add_input("text", "College: ", "college", "", False);
            $onboard_2->add_input("text", "Major: ", "major", "", False);
            $onboard_2->add_input("text", "Minor: ", "minor", "", False);
            $onboard_2->add_input("text", "Certificate: ", "cert", "", False);
        $onboard_2->end_form();
        
        ?>
    </div>

    <div class="row <?php if($stage != 3) echo "hidden"; ?>">
        <?php
        #### STAGE 3 ####

        $onboard_3 = new bs_form("onboard_3", "minutecode.org/onboard_user.php?uid=$ONBOARD_UID");
        
        if($onboard_3->process_form()){
            
            $onboard_3->check_input("langs");
    
            update_field("user_info", "langs", $_POST["langs"], "uid", $ONBOARD_UID);

            update_field("user_info", "onboard_stage", "4", "uid", $ONBOARD_UID);

            $onboard_3->form_kickback("", "");
        }

        $onboard_3->start_form("post", "form-horizontal", "Skills", 50);
            $onboard_3->add_input("text", "Languages: ", "langs", "", False);
        $onboard_3->end_form();
        
        ?>
    </div>

    <div class="row <?php if($stage != 4) echo "hidden"; ?>">
        <?php
        #### STAGE 4 ####

        $onboard_4 = new bs_form("onboard_4", "minutecode.org/onboard_user.php?uid=$ONBOARD_UID");
        
        if($onboard_4->process_form()){
            
            $onboard_4->check_input("pswd");
            $onboard_4->check_input("pswdc");

            $onboard_4->check_pswd();
    
            update_field("users", "password", md5($_POST["pswd"]), "uid", $ONBOARD_UID);
            update_timestamp_field("users", "password_last_change", "uid", $ONBOARD_UID);
            

            update_field("user_info", "onboard_stage", "5", "uid", $ONBOARD_UID);

            //FIXME: update onboard date

            $onboard_4->form_kickback("", "");
        }

        $onboard_4->start_form("post", "form-horizontal", "Change Password", 75);
            $onboard_4->add_input("password", "Password: ", "pswd", "", False);
            $onboard_4->add_input("password", "Confirm Password: ", "pswdc", "", False);
        $onboard_4->end_form();
        
        ?>
    </div>

    <div class="row <?php if($stage != 5) echo "hidden"; ?>">
        <?php
        #### STAGE 5 ####

        $onboard_5 = new bs_form("onboard_5", "minutecode.org/dev_home.php");

        $onboard_5->start_form("post", "form-horizontal", "Onboarding Complete", 100);
            $onboard_5->add_text("Thank you for completing the onboarding process. Please allow a few days 
            for our staff to contact you with further infomation. Feel free to poke around the
            devportal and see what projects we are working on.");
            $onboard_5->ovveride_submit("Go to Devportal");
        $onboard_5->end_form();
        
        ?>
    </div>

</div>



<?php 

require($ASSETS_FOLDER."footer.php");

?>
