<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="http://minutecode.org/dev_home.php">Minute Code Dev Portal</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="nav navbar-nav">
                    <!-- Projects -->
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Projects </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Projects</a></li>
                            <li role="presentation"><a href="#">All Projects</a></li>
                        </ul>
                    </li>
                    <!-- The Team -->
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">The Team</a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Team</a></li>
                            <li role="presentation"><a href="#">Executive Board </a></li>
                        </ul>
                    </li>
                    <!-- Assignment -->
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">The Team</a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation" class="<?php show("assign:user_to_team", true);?>" ><a href="http://minutecode.org/admin/team_assignment.php">Privilege Keys</a></li>
                        </ul>
                    </li>
                    <!-- Admin -->
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">The Team</a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Team</a></li>
                            <li role="presentation"><a href="#">Executive Board </a></li>
                        </ul>
                    </li>
                    <!-- User -->
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Admin </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation" class="<?php show("admin:view_privilege_keys", true);?>" ><a href="http://minutecode.org/admin/privilege_keys.php">Privilege Keys</a></li>
                            <li role="presentation" class="<?php show("admin:view_manage_projects", true);?>" ><a href="http://minutecode.org/admin/manage_projects.php">Manage Projects</a></li>
                            <li role="presentation" class="<?php show("admin:view_manage_users", true);?>" ><a href="http://minutecode.org/admin/manage_users.php">Manage Users</a></li>
                            <li role="presentation" class="<?php show("admin:view_manage_teams", true);?> " ><a href="http://minutecode.org/admin/manage_teams.php">Manage Teams</a></li>
                            <li role="presentation" class="<?php show("admin:view_manage_clients", true);?> " ><a href="http://minutecode.org/admin/manage_clients.php">Manage Clients</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#"><?php echo get_user_info($GLOBAL_UID, "rank").", ".get_user_info($GLOBAL_UID, "fname")." ".get_user_info($GLOBAL_UID, "lname"); ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#">My Profile</a></li>
                            <li role="presentation"><a href="http://minutecode.org/self/change_password.php">Change Password</a></li>
                            <li role="presentation"><a href="http://minutecode.org/assets/logout.php">Logout </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
