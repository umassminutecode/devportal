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
    $ONBOARD_UID;
    $STAGE

?>


<div class="container-fluid">

    <div class="row">
        <?php
        #### STAGE 0 ####

        start_form('post', 'onboard-0', 'form-horizontal', "Onboarding", -1);
            add_text('Welcome to the minutecode onboarding process. This should only take a few minutes to complete...');
            add_input('text', 'Username: ', 'username', '$ONBOARD_UID', False, array("readonly"));
            add_input('text', 'Code:', 'code', True);
            add_submit('', 'Next');
        end_form();

        ?>
    </div>

    <div class="row">
        <?php
        #### STAGE 1 ####

        start_form('post', 'onboard-1', 'form-horizontal', "Basic Info", 0);
            add_input('text', 'First Name: ', 'fname', '', False);
            add_input('text', 'Last Name: ', 'lname', '', False);
            add_input('email', 'UMASS Email: ', 'uemail', '', False);
            add_input('email', 'Personal Email: ', 'pemail', '', False);
            add_input('tel', 'Phone Number: ', 'tel', '', False);
            add_submit('', 'Next');
        end_form();

        ?>
    </div>

    <div class="row">
        <?php
        #### STAGE 2 ####

        start_form('post', 'onboard-2', 'form-horizontal', "Academic Info", 25);
            add_input('month', 'Enrollment: ', 'eyear', '', False);
            add_input('month', 'Graducation: ', 'eyear', '', False);
            add_input('text', 'College: ', 'eyear', '', False);
            add_input('text', 'Major: ', 'eyear', '', False);
            add_input('text', 'Minor: ', 'eyear', '', False);
            add_input('text', 'Certificate: ', 'eyear', '', False);
            add_submit('', 'Next');
        end_form();
        
        ?>
    </div>

    <div class="row">
        <?php
        #### STAGE 3 ####

        start_form('post', 'onboard-2', 'form-horizontal', "Skills", 50);
            add_input('text', 'Languages: ', 'langs', '', False);
            add_submit('', 'Next');
        end_form();
        
        ?>
    </div>

    <div class="row">
        <?php
        #### STAGE 4 ####

        start_form('post', 'onboard-2', 'form-horizontal', "Change Password", 75);
            add_input('password', 'Password: ', 'pswd', '', False);
            add_input('password', 'Confirm Password: ', 'pswdc', '', False);
            add_submit('', 'Enroll');
        end_form();
        
        ?>
    </div>

    <div class="row">
        <?php
        #### STAGE 5 ####

        start_form('post', 'onboard-2', 'form-horizontal', "Complete", 100);
            add_text('Thank you for completing the onboarding process. Please allow a few days 
            for our staff to contact you with further infomation. Feel free to poke around the
            devportal and see what projects we are working on.');
            add_submit('', 'Go To DevPortal');
        end_form();
        
        ?>
    </div>

</div>



<?php 

require($ASSETS_FOLDER."footer.php");

?>
