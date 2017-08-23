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
                
                db_table_to_html_table("users");

                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php
                
                db_table_to_html_table("user_info", "id, uid AS 'User ID', fname AS 'First Name', lname as 'Last Name', uemail as 'UMASS Email', type as 'Type'");

                ?>
            </div>
        </div>
    </div>


</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>
