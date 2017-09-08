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

    require($ASSETS_FOLDER."header.php");


    $check = check_key("30649719", "admin", "privilege_keys", True);


?>





<?php 

require($ASSETS_FOLDER."footer.php");

?>
