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
    $PAGE_KEY = "admin:privilege_keys";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");



?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Privilege Keys [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php
                
                db_table_to_html_table("privilege_keys");

                ?>
            </div>
        </div>
    </div>


</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>