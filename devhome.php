<?php
	session_start();
	include "key_check.php";
	require "connection.php";
	include "header_vars.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinuteCode</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/Team-Boxed.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-default navigation-clean-button" style="border-bottom:#66d7d7 1px solid;">
            <div class="container">
                <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">MInute Code Dev Portal</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="active" role="presentation"><a href="#">Projects </a></li>
                        <li role="presentation"><a href="#">The Team</a></li>
                        <li role="presentation"><a href="#">Requests (XX)</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Administration <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a href="#">Manage Team</a></li>
                                <li role="presentation"><a href="#">Manage Projects</a></li>
                                <li role="presentation"><a href="#">Portal Dev Controls</a></li>
                            </ul>
                        </li>
                    </ul>
                    <p class="navbar-text navbar-right actions"> <a class="btn btn-default action-button" role="button" href="#"><?php echo $name; ?>'s Profile</a></p>
                </div>
            </div>
        </nav>
    </div>
	<div class="team-boxed">
        <div class="container">
			<?php
			
				//Grab the list of active projects (This may later involve permissions but we shall see)
				$query = "SELECT * FROM projects WHERE active='1'";
				$result = mysqli_query($conn, $query);
				
				//Row calculations
				$count = mysqli_num_rows($result);
				$rows = ($count/3);
				$counter = 0;
				
				//Row loop
				for ( $i = 0; $i < $rows; $i++){
					echo '<div class="row">';
					
					//Column loop (3 times for every row as needed)
					for ( $x = 0; $x < 3; $x++){
						$counter++;
						
						//Get the specific result and create the box
						$project = mysqli_fetch_assoc($result);
						
						echo '<div class="col-md-4 col-sm-6 item">';
						echo '<div class="box" style="border: #000000 1px solid;"><img class="img-circle" src="assets/img/project_imgs/'.$project['img_url'].'">';
						echo '<h3 class="name">'.$project['name'].' </h3>';
						
						//Get the PL's name
						$query="SELECT * FROM members WHERE id='".$project['project-lead']."'";
						$result_2 = mysqli_query($conn, $query);
						$member = mysqli_fetch_assoc($result_2);
						$pl_name = $member['first-name'].' '.$member['last-name'];
						
						echo '<p class="title">'.$pl_name.' </p>';
						echo '<p class="description">'.$project['short-desc'].' </p>';
						echo '<div class="social"><a href="http://'.$project['trello-board'].'"><i class="fa fa-trello"></i></a><a href="http://'.$project['github-project'].'"><i class="fa fa-github"></i></a><a href="THIS GOES NOWHERE YET SORRY"><i class="fa fa-vcard-o"></i></a></div>';
						echo '</div>';
						echo '</div>';
						
						//Break the loops if we run out of projects
						if($counter == $count){
							echo '</div>';
							break(2);
						}
					}
					echo '</div>';
				}
			?>
		</div>
	</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>