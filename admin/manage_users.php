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
    $PAGE_KEY = "admin:view_manage_users";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");


    ####################
    # ADD USER RECEIVE #
    ####################

    $add_user = new bs_form("add_user", "minutecode.org/admin/manage_users.php");
    if($add_user->process_form()){

        if(has_privilege("admin", "create_user", False)){
            $add_user->form_kickback("alert-danger", "You do not have the rights to do this.");
        }
        
        $add_user->check_input("uid");
        $add_user->check_input("username");
        $add_user->check_input("email");

        $add_user->check_if_field_exist_in_table("users", "uid");
        $add_user->check_if_field_exist_in_table("users", "username");

        insert_into_table("users", array("uid", "username"), array($_POST["uid"], $_POST["username"]));
        insert_into_table("user_info", array("uid", "uemail", "type"), array($_POST["uid"], $_POST["email"], $_POST["type"]));

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

                $sql = "SELECT users.uid AS 'User ID', users.username AS 'Username', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Name', user_info.rank AS Rank, user_info.type as 'Type', user_info.uemail as 'Email'
                FROM users
                INNER JOIN user_info ON users.uid = user_info.uid";

                
                
                //table declaration
                echo "<table id=\"users\" class=\"display\" cellspacing=\"0\" width=\"100%\" style=\"text-align:center;\">";
                
                //Table Body
                $query = query_db($sql);
                $keys = array_keys(next_result($query));
            
                //Table Head
                echo "<thead> <tr>";

                foreach ($keys as &$field){
                    echo "<td>".$field."</td>";
                }
                
                echo "<td>Edit</td>";
                echo "<td>Lock</td>";
                echo "<td>Access</td>";
            
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
                    $row_uid = $result["User ID"];

                    //Hamburger
                    echo "<td>";
                    display_icon("menu-hamburger", "black", "edit_user.php?uid=$row_uid");
                    echo "</td>";
                    
                    //Lock
                    echo "<td>";
                    if(get_user_field($row_uid, "locked") == True){
                        display_icon("lock", "red", "edit_user.php?uid=$row_uid");
                    }else{
                        display_icon("lock", "black", "edit_user.php?uid=$row_uid");
                    }
                    echo "</td>";

                    //Access
                    echo "<td>";
                    display_icon("log-in", "black", "edit_user.php?uid=$row_uid");
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

        if(has_privilege("admin", "create_user", True)){
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
        //TODO: based on member type
        if($('#type').val() == "Member"){
            $('#email').val($(this).val()+"@umass.edu");
        } 
    });

    $('#type').change(function () {
        //TODO: based on member type
        if($('#type').val() == "Member"){
            $('#email').attr('readonly', 'readonly'); 
        }else{
            $('#email').val('');
            $('#email').removeAttr('readonly');
        }
        
    });
</script>