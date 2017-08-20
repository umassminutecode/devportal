<?php
    require_once('auth.php');
	require_once('connection.php');
    
    //Start session
	session_start();

	// Create connection
	$conn = new mysqli($servername, $servusername, $servpassword);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	mysqli_select_db($conn, "tomkelle_change");
    
    $username = $_SESSION['SESS_MEMBER_ID'];
	$account = $_SESSION['SESS_MEMBER_ACCOUNT'];
    $name = $_SESSION['SESS_MEMBER_NAME'];
    
    $result = mysqli_query($conn, "SELECT * FROM accounts WHERE account='$account'");
    $row = mysqli_fetch_assoc($result);
    $company_name = $row['company_name'];
    
    $result = mysqli_query($conn, "SELECT * FROM access WHERE account='$account' AND username='$username'");
    $row = mysqli_fetch_assoc($result);
    $location = $row['location'];
    
    $result = mysqli_query($conn, "SELECT * FROM locations WHERE linked_account='$account' AND location_id='$location'");
    $row = mysqli_fetch_assoc($result);
    $location_name = $row['location'];
    
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Order</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Button-Change-Text-on-Hover.css">
    <link rel="stylesheet" href="assets/css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS.css">
    <link rel="stylesheet" href="assets/css/Navbar---App-Toolbar--LG--MD---Mobile-Nav--SM--XS1.css">
    <link rel="stylesheet" href="assets/css/Pretty-Login-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
    
        $(document).ready(function() {
            $('#users').DataTable( {
                "paging":   false,
                "bSort": true,
            } );
        } );
    
    </script>
    
    
    
    
    <style  media="screen" type="text/css">
    td 
    {
        text-align:center; 
        vertical-align:middle;
    }
    th 
    {
        text-align:center; 
        vertical-align:middle;
    }
    </style>
</head>

<body>
    <div class="panel panel-default">
        <div class="panel-heading">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="home.php">&lt;Bank&gt; Change Order</a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><i class="glyphicon glyphicon-menu-hamburger"></i></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <p class="navbar-text"><?php echo $company_name;?>  <?php echo $location_name; if($location > 0) echo " #".$location;?></p>
                        <p class="navbar-text navbar-right"><a class="navbar-link" href="logout.php">Logout </a></p>
                        <p class="navbar-text navbar-right">Logged in as: <?php echo $name; ?> </p>
                    </div>
                </div>
            </nav>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                
                    <div role="alert" class="alert alert-info text-center">
                        <a href="edituser.php" class="alert-link">Create New User</a>
                    </div>
                
                    <div role="alert" class="alert <?php if( isset($_SESSION['USER_LOCK_COLOR'])) {echo $_SESSION['USER_LOCK_COLOR'];} unset($_SESSION['USER_LOCK_COLOR'])?> text-center <?php if( isset($_SESSION['USER_LOCK']) == false) {echo 'hidden';}?>">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span><strong><?php echo $_SESSION['USER_LOCK']; unset($_SESSION['USER_LOCK'])?></strong></span>
                    </div>
                </div>
                </div> 
                <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive wrapper container">
                        <table id="users" class="table table-striped table-bordered" style="overflow-x:hidden !important;">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Location(s)</th>
                                    <th>Edit User</th>
                                    <th>Reset Password</th>
                                    <th>Lock/Unlock</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE linked_account='$account'");
                                
                                while($row = mysqli_fetch_assoc($result)){
									
									$show = true;
									
                                    $id = $row['id'];
                                    $username = $row['username'];
                                    $full_name = $row['full_name'];
                                    $position = $row['position'];
                                    $locked = $row['locked'];
									$deleted = $row['deleted'];
                                    $locations = array();
                                    
									if($deleted == '1'){
										$show = false;
									}
									
                                    $result2 = mysqli_query($conn, "SELECT * FROM access WHERE account='$account' AND username='$username'");
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        $location = $row2['location'];
                                        $result3 = mysqli_query($conn, "SELECT * FROM locations WHERE linked_account='$account' AND location_id='$location'");
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $location_name = $row3['location'];
                                        
                                        if($location == "0"){
                                            array_push($locations, ($location_name));
                                        }else{
                                            array_push($locations, ("#".$location." ".$location_name));
                                        }
                                    }
                                    
									if($show){
										echo "<tr>";
										
										echo "<td>".$username."</td>";
										echo "<td>".$full_name."</td>";
										echo "<td>".$position."</td>";
										echo "<td>";
										foreach ($locations as $location){
											echo $location."</br>";
										}
										echo "</td>";
										
										echo "<td><a href=\"edituser.php?edit_user_id=".$id."\"><i class=\"glyphicon glyphicon-menu-hamburger\"></i></a></td>";
										echo "<td><a href=\"reset.php?reset_user_id=".$id."\"><i class=\"fa fa-key\"></i></a></td>";
										if($locked == "0"){
											echo "<td class=\"success\"><a href=\"lock.php/?id=".$id."\"><i class=\"fa fa-lock\"></i></a></td>";
										}else{
											echo "<td class=\"danger\"><a href=\"lock.php/?id=".$id."\"><i class=\"fa fa-unlock\"></i></a></td>";
										}
										
										echo "</tr>";
										
									}
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style  media="screen" type="text/css">
        #users 
        {    
            overflow-y:scroll !important;
            overflow-x:hidden !important; 
        }
    </style>
   

<?php

    require_once('authtimer.php');

?>
    
</html>