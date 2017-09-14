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

    ######################
    # Create Key Receive #
    ######################

    $add_key = new bs_form("add_key", "minutecode.org/admin/privilege_keys.php");
    if($add_key->process_form()){
        
        if(has_privilege("admin", "create_privilege_key", False)){
            $add_key->form_kickback("alert-danger", "You do not have the rights to do this.");
        }
        
        $add_key->check_input("key_type");
        $add_key->check_input("cat");
        $add_key->check_input("key_char");
        $add_key->check_input("usage_ref");

        insert_into_table("privilege_keys", array("cat", "key_char", "key_type", "usage_ref"), array($_POST["cat"], $_POST["key_char"], $_POST["key_type"], $_POST["usage_ref"]));


        $add_key->form_kickback("alert-success", "Key <b>".$_POST["cat"].":".$_POST["key_char"]."</b> added.");
    }

    ######################
    # Delete Key Receive #
    ######################

    $del_key = new bs_form("del_key", "minutecode.org/admin/privilege_keys.php");
    if($del_key->process_form()){
        
        if(has_privilege("admin", "delete_privilege_key", False)){
            $del_key->form_kickback("alert-danger", "You do not have the rights to do this.");
        }
        
        $del_key->check_input("id");

        delete_table_row("privilege_keys", "id", $_POST["id"]);

        $del_key->form_kickback("alert-success", "Key with id <b>".$_POST["id"]."</b> deleted.");
    }
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Privilege Keys</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php

                $sql = "SELECT id AS 'Key ID', cat AS 'Category', key_char AS 'Key', key_type AS 'Key Type', usage_ref AS 'Usage Refrence'
                FROM privilege_keys";

                db_select_to_html_table("privilege_keys", $sql, "\"order\": [[ 1, \"asc\" ], [ 2, \"asc\" ]]");

                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php

            ##########################
            # Generated Add Key Form #
            ##########################

            if(has_privilege("admin", "create_privilege_key", True)){
                $add_key->start_form("post", "form-horizontal", "Create Privilege Key", -1, "col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3");
                    $add_key->add_select("Key Type:", "key_type", "TF", False, False, array("TF", "UID", "GID", "PID"));
                    $add_key->add_input("text", "Category:", "cat", "", "", False);
                    $add_key->add_input("text", "Key Char:", "key_char", "", "", False);
                    $add_key->add_input("text", "Refrence:", "usage_ref", "", False );
                $add_key->end_form();
            }
        
            ?>
        </div>

        <div class="col-md-6">
            <?php

            #############################
            # Generated Delete Key Form #
            #############################

            if(has_privilege("admin", "delete_privilege_key", True)){
                $del_key->start_form("post", "form-horizontal", "Delete Privilege Key", -1, "col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-lg-6 col-lg-offset-3");
                    $del_key->add_input("number", "Key ID:", "id", "", False);
                    $del_key->ovveride_submit("Delete Privilege Key");
                $del_key->end_form();
            }
        
            ?>
        </div>
    </div>


</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>