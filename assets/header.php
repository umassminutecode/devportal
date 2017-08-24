<?php

###############################
# Loaded on top of every page #
# Contains the bootstrap refs #
###############################

require("dbfunctions.php");
require("bs_form.php");

//Check user auth and store user info

$GLOBAL_UID = "30649719"; //Hardcoded for now

//Redirect user if they go to a page they shouldn't be on
global $ASSETS_FOLDER;
global $PAGE_KEY;
global $PAGE_TARGET;

if($PAGE_KEY != "")
    show_page($PAGE_KEY, $PAGE_TARGET);


?>

<!DOCTYPE html>
<html>

<?php
#############################
# GLOBAL HEAD FOR ALL PAGES #
#############################
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devportal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/navbar.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo $ASSETS_FOLDER; ?>css/form-gen.css">

    <!-- Data Tables Loading -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

</head>

<?php
#############################
# GLOBAL HEAD FOR ALL PAGES #
#############################
?>







<?php
#################
# GLOBAL NAVBAR #
#################
?>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="http://minutecode.org/dev_home.php">Minute Code Dev Portal</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Projects </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Projects</a></li>
                            <li role="presentation"><a href="#">All Projects</a></li>
                            <li role="presentation"><a href="#">Manage Projects</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">The Team</a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Team</a></li>
                            <li role="presentation"><a href="#">Board </a></li>
                            <li role="presentation" <?php show("admin:manage_team", true);?>" ><a href="http://minutecode.org/admin/manage_team.php">Manage Team</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Admin </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation" class="<?php show("admin:privilege_keys", true);?>" ><a href="http://minutecode.org/admin/privilege_keys.php">Privilege Keys</a></li>
                            <li role="presentation"><a href="#">Project Managment</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#"><?php echo get_user_info($GLOBAL_UID, "rank").", ".get_user_info($GLOBAL_UID, "fname")." ".get_user_info($GLOBAL_UID, "lname"); ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Profile</a></li>
                            <li role="presentation"><a href="#">Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<?php
#################
# GLOBAL NAVBAR #
#################
?>

</html>