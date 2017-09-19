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
    $PAGE_KEY = "admin:view_manage_clients";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");


    ####################
    # ADD USER RECEIVE #
    ####################

    $add_client = new bs_form("add_client", "minutecode.org/admin/manage_clients.php");
    if($add_client->process_form()){

        if(has_privilege("admin", "create_client", False)){
            $add_client->form_kickback("alert-danger", "You do not have the rights to do this.");
        }
        
        $add_client->check_input("cid");
        $add_client->check_input("name");
        $add_client->check_input("address");
        $add_client->check_input("primary_contact");

        $add_client->check_if_field_exist_in_table("clients", "cid");
        $add_client->check_if_field_exist_in_table("clients", "name");

        insert_into_table("clients", array("cid", "name", "address", "primary_contact"), array($_POST["cid"], $_POST["name"], $_POST["address"], $_POST["primary_contact"]));

        $add_client->form_kickback("alert-success", "User <b>".$_POST["username"]."</b> with uid <b>".$_POST["uid"]."</b> added. <i>Sending onboard email to ".$_POST["email"]."</i>");
        
    }

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center page-heading">Client Managment [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php

                $sql = "SELECT clients.cid AS 'Client ID', clients.state AS 'State', clients.name AS 'Company', clients.address AS 'Address', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Primary Contact'
                FROM clients
                INNER JOIN user_info ON clients.primary_contact = user_info.uid";

                
                
                //table declaration
                echo "<table id=\"clients\" class=\"display\" cellspacing=\"0\" width=\"100%\" style=\"text-align:center;\">";
                
                //Table Body
                $query = query_db($sql);
                $keys = array_keys(next_result($query));
            
                //Table Head
                echo "<thead> <tr>";

                foreach ($keys as &$field){
                    echo "<td>".$field."</td>";
                }
                
                echo "<td>Edit</td>";
            
                echo "</thead> </tr>";
            
                unset($query, $field);
            
                $query = query_db($sql);
            
                echo "<tbody>";
                while($result = next_result($query)){
                    echo "<tr>";
            
                    foreach ($keys as &$field){
                        echo "<td>".$result[$field]."</td>";
                    }

                    //User control links here
                    $row_uid = $result["Client ID"];

                    //Hamburger
                    echo "<td>";
                    echo "<a href=\"edit_user.php?uid=$row_uid\" ><img src=\"http://minutecode.org/assets/img/icon/glyphicons-517-menu-hamburger.png  \" ></img></a>";
                    echo "</td>";
            
                    echo "</tr>";
                }
                echo "</tbody>";
            
            
                echo "</table>";

                ready_datatable("clients", "\"order\": [[ 1, \"asc\" ], [ 2, \"asc\" ]]");

                ?>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <br/>
    <br/>

    <scrpit>

    </script>

    <div class="row">
        <?php

        ###########################
        # Generated Add User Form #
        ###########################

        if(has_privilege("admin", "create_client", True)){
            $add_client->start_form("post", "form-horizontal", "Add New Client");
                $add_client->add_input("number", "CID: ", "cid", "", False);
                $add_client->add_input("text", "Name: ", "name", "", False);
                $add_client->add_input("text", "Address:", "address", "", False);
                $add_client->add_input("number", "Primary Contact (UID):", "primary_contact", "", False);
            $add_client->end_form();
        }
       
        ?>
    </div>

</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>