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
    $PAGE_KEY = "admin:view_manage_teams";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");


    ####################
    # ADD TEAM RECEIVE #
    ####################

    $add_team = new bs_form("add_team", "minutecode.org/admin/manage_teams.php");
    if($add_team->process_form()){

        if(has_privilege("admin", "create_team", False)){
            $add_team->form_kickback("alert-danger", "You do not have the rights to do this.");
        }
        
        $add_team->check_input("team_name");
        $add_team->check_input("team_lead");

        $add_team->check_if_field_exist_in_table("teams", "team_name");

        insert_into_table("teams", array("team_name", "team_lead"), array($_POST["team_name"], $_POST["team_lead"]));

        $add_team->form_kickback("alert-success", "Team <b>".$_POST["team_name"]."</b> added.");
        
    }

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center page-heading">Team Managment [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php

                $sql = "SELECT teams.tid AS 'Team ID', teams.active AS 'Active', teams.team_name AS 'Team Name', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Team Lead'
                FROM teams
                INNER JOIN user_info ON teams.team_lead = user_info.uid";

                
                
                //table declaration
                echo "<table id=\"teams\" class=\"display\" cellspacing=\"0\" width=\"100%\" style=\"text-align:center;\">";
                
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
                        if($field == "Active"){
                            echo "<td>".($result[$field] ? 'True' : 'False')."</td>";
                        }else{
                            echo "<td>".$result[$field]."</td>";
                        }
                        
                    }

                    //User control links here
                    $row_tid = $result["Team ID"];

                    //Hamburger 
                    echo "<td>";
                    echo "<a href=\"edit_team.php?tid=$row_tid\" ><img src=\"http://minutecode.org/assets/img/icon/glyphicons-517-menu-hamburger.png  \" ></img></a>";
                    echo "</td>";
            
                    echo "</tr>";
                }
                echo "</tbody>";
            
            
                echo "</table>";

                ready_datatable("teams", "\"order\": [[ 1, \"asc\" ], [ 0, \"asc\" ]]");

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
        # Generated Add Team Form #
        ###########################

        if(has_privilege("admin", "create_team", True)){
            $add_team->start_form("post", "form-horizontal", "Add New Team");
                $add_team->add_input("text", "Team Name: ", "team_name", "", False);
                $add_team->add_input("number", "Team Lead (UID): ", "team_lead", "", False);
            $add_team->end_form();
        }
       
        ?>
    </div>

</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>