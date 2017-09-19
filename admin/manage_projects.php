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
    $PAGE_KEY = "admin:view_manage_projects";
    $PAGE_TARGET = True;

    require($ASSETS_FOLDER."header.php");


    ####################
    # ADD TEAM RECEIVE #
    ####################

    $add_proj = new bs_form("add_proj", "minutecode.org/admin/manage_projects.php");
    if($add_proj->process_form()){

        if(has_privilege("admin", "create_project", False)){
            $add_proj->form_kickback("alert-danger", "You do not have the rights to do this.");
        }
        
        $add_proj->check_input("team_name");
        $add_proj->check_input("team_lead");

        $add_proj->check_if_field_exist_in_table("teams", "team_name");

        insert_into_table("teams", array("team_name", "team_lead"), array($_POST["team_name"], $_POST["team_lead"]));

        $add_proj->form_kickback("alert-success", "Team <b>".$_POST["team_name"]."</b> added.");
        
    }

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center page-heading">Project Managment [WIP]</h1></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <?php

                $sql = "SELECT projects.pid AS 'Project ID', projects.active AS 'Active', projects.stage AS 'Stage', projects.project_name AS 'Project Name', clients.name AS 'Client', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Project Lead', teams.team_name AS 'Team'
                FROM projects
                INNER JOIN user_info ON projects.project_lead = user_info.uid
                INNER JOIN clients ON projects.cid = clients.cid
                INNER JOIN teams ON projects.team = teams.tid
                ";

                
                
                //table declaration
                echo "<table id=\"projects\" class=\"display\" cellspacing=\"0\" width=\"100%\" style=\"text-align:center;\">";
                
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

                ready_datatable("projects", "\"order\": [[ 1, \"asc\" ], [ 0, \"asc\" ]]");

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

        if(has_privilege("admin", "create_project", True)){
            $add_proj->start_form("post", "form-horizontal", "Add New Team");
                $add_proj->add_input("number", "Client ID: ", "client_uid", "", False);
                $add_proj->add_input("number", "Project Lead: ", "project_lead", "", False);
                $add_proj->add_input("number", "Team (TID): ", "team", "", False);
            $add_proj->end_form();
        }
       
        ?>
    </div>

</div>

<?php 

require($ASSETS_FOLDER."footer.php");

?>