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
    $PAGE_KEY = "admin:manage_team";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");



?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">User Managment [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php

                $sql = "SELECT users.uid AS 'User ID', users.username AS 'Username', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Name', user_info.type as 'Type', user_info.uemail as 'UMASS Email'
                FROM users
                INNER JOIN user_info ON users.uid = user_info.uid";

                db_select_to_html_table("users", $sql);

                ?>
            </div>
        </div>
    </div>

</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>
