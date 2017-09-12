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


    ####################
    # ADD USER RECEIVE #
    ####################

    $add_user = new bs_form("add_user", "minutecode.org/admin/manage_team.php");
    if($add_user->process_form()){
        
        $add_user->check_input("uid");
        $add_user->check_input("username");
        $add_user->check_input("email");

        $add_user->check_if_field_exist_in_table("users", "uid");
        $add_user->check_if_field_exist_in_table("users", "username");

        insert_into_table("users", array("uid", "username"), array($_POST["uid"], $_POST["username"]));
        insert_into_table("user_info", array("uid", "uemail", "type"), array($_POST["uid"], $_POST["email"], $_POST["type"]));
        
        //FIXME:update create date

        $add_user->form_kickback("alert-success", "User <b>".$_POST["username"]."</b> with uid <b>".$_POST["uid"]."</b> added. <i>Sending onboard email to ".$_POST["email"]."</i>");
        
    }

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center page-heading">User Managment [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php

                $sql = "SELECT users.uid AS 'User ID', users.username AS 'Username', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Name', user_info.type as 'Type', user_info.uemail as 'UMASS Email'
                FROM users
                INNER JOIN user_info ON users.uid = user_info.uid";

                
                
                //table declaration
                echo "<table id=\"users\" class=\"display\" cellspacing=\"0\" width=\"100%\">";
                
                //Table Body
                $query = query_db($sql);
                $keys = array_keys(next_result($query));
            
                //Table Head
                echo "<thead> <tr>";

                foreach ($keys as &$field){
                    echo "<td>".$field."</td>";
                }
                
                echo "<td><img src=\"http://minutecode.org/assets/img/icon/glyphicons-517-menu-hamburger.png\" ></img></td>";
            
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
                    $row_uid = $result["users.uid"];
                    echo "<td>";
                    echo "<a href=\"edit_user.php?uid=$row_uid\" ><img src=\"http://minutecode.org/assets/img/icon/glyphicons-517-menu-hamburger.png  \" ></img></a>";
                    echo "</td>";
            
                    echo "</tr>";
                }
                echo "</tbody>";
            
            
                echo "</table>";

                ready_datatable("users");

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

        if(has_privilege("admin", "add_user", True)){
            $add_user->start_form("post", "form-horizontal", "Add New User");
                $add_user->add_select("Type:", "type", "", False, False, array("Member", "Client", "Bot"));
                $add_user->add_input("number", "UID: ", "uid", "", False);
                $add_user->add_input("text", "Username: ", "username", "", False);
                $add_user->add_input("text", "Email:", "email", "", False, True);
            $add_user->end_form();
        }
       
        ?>
    </div>

</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>
<script>
    $('#username').keyup(function () {
        $('#email').val($(this).val()+"@umass.edu");
    });
</script>