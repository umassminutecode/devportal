<?php 

    ##########################
    # TEMPLATE FOR NEW PAGES #
    # REFRENCES HEADER.PHP   #
    #         + FOOTER.PHP   #
    #                        #
    # MAKE SURE TO UPDATE    #
    # THE ASSETS REFRENCE    #
    ##########################

    $ASSETS_FOLDER = "assets/";
    $PAGE_KEY = "";
    $PAGE_TARGET = "";

    require($ASSETS_FOLDER."header.php");

    //Getting boxes ready
    $project_test = new bs_box();
    $project_test->boxes_start();
    $project_test->row_start();

    //Database stuff
    $sql = "SELECT projects.pid AS 'Project ID', projects.stage AS 'Stage', projects.project_name AS 'Project Name', clients.name AS 'Company', CONCAT(user_info.fname, ' ', user_info.lname) AS 'Project Lead', teams.team_name AS 'Team', CONCAT(client_info.fname, ' ', client_info.lname) AS 'Primary Contact'
    FROM projects
    INNER JOIN user_info ON projects.project_lead = user_info.uid
    INNER JOIN clients ON projects.cid = clients.cid
    INNER JOIN user_info AS client_info ON clients.primary_contact = client_info.uid
    INNER JOIN teams ON projects.team = teams.tid
    WHERE projects.active = True
    ";
    $query = query_db($sql);

    //for row counting
    $i = 0;

    //Main loop
    while($result = next_result($query)){
        $i += 1;

        if($i == 4){
            $project_test->row_end();
            $project_test->row_start();
            $i = 1;
        }

        $project_test->box_start();
        $project_test->box_display_headline($result["Project Name"]);
        $project_test->box_display_subheadline($result["Stage"]);
        $project_test->box_display_hr();
        $project_test->box_display_lineheader("Client");
        $project_test->box_display_line($result["Company"]);
        $project_test->box_display_line("Primary Contact: ".$result["Primary Contact"]);
    
        $project_test->box_display_lineheader("Dev Team");
        $project_test->box_display_line("Proect Lead: ".$result["Project Lead"]);
        $project_test->box_display_line("Team: ".$result["Team"]);
        $project_test->box_end();
    }

    $project_test->row_end();

    $project_test->boxes_end();


require($ASSETS_FOLDER."footer.php");

?>
