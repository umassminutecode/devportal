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
    $PAGE_KEY = "assign:user_to_team";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");

    ##Tab Headers

    $sql = "SELECT team_name
    FROM team
    WHERE active=\"1\"
    ";

    $tabs = new bs_tabs();
    $tabs->start_tabs(array("Tab 1", "Tab 2"));


    
    $tabs->start_tab();
    echo "test 1";
    $tabs->end_tab();

    $tabs->start_tab();
    echo "test 2";
    $tabs->end_tab();

    $tabs->end_tabs();

    require($ASSETS_FOLDER."footer.php");

?>
