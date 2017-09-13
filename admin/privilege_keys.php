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
    $PAGE_KEY = "admin:view_privilege_keys";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");

    $add_key = new bs_form("add_key", "minutecode.org/admin/manage_team.php");

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

    <div class="row">
        <?php

        ###########################
        # Generated Add User Form #
        ###########################

        if(has_privilege("admin", "create_privilege_key", True)){
            $add_key->start_form("post", "form-horizontal", "Create Privilege Key");
                $add_key->add_select("Key Type:", "key_type", "TF", False, False, array("TF", "UID", "GID", "PID"));
                $add_key->add_input("text", "Category:", "cat", "", "", False);
                $add_key->add_input("text", "Key Char:", "key_char", "", "", False);
                $add_key->add_input("text", "Refrence:", "usage_ref", "", False );
            $add_key->end_form();
        }
       
        ?>
    </div>


</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>