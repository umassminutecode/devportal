<?php

  ################################
  # Session Variables:
  #     ERRMSG_ARR: A PHP array of error messages
  #     ERRMSG_CLR: A string of the bootstrap studio box colors
  #                 danger   - red
  #                 warning  - yellow
  #                 success  - green
  #                 info     - blue
  ################################

  ## Gather error message array info. For a new user this would never be set
	session_start();
	if(isset($_SESSION['ERRMSG_ARR'])){
		$errmsg_arr = $_SESSION['ERRMSG_ARR'];
	}else{
		$errmsg_arr = null;
	}

	if(isset($_SESSION['ERRMSG_CLR'])){
		$errmsg_clr = $_SESSION['ERRMSG_CLR'];
	}else{
		$errmsg_clr = "danger";
	}
	unset($_SESSION['ERRMSG_CLR']);
	unset($_SESSION['ERRMSG_ARR']);
	session_write_close();
?>


  <!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinuteCode Login</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
  </head>

  <body>
    <div class="login-dark">
      <form action="auth.php" method="post">

        <h2 class="sr-only">Login Form</h2>

        <div class="illustration"><img src="assets/img/MinuteCodePlaceholderLogo-light.png">
          <p style="font-size:24px;">Dev Portal Login</p>
        </div>

        <div class="form-group">
          <input class="form-control" type="text" name="username" placeholder="Username">
        </div>

        <div class="form-group">
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>

        <div class="alert alert-<?php echo $errmsg_clr; ?>" role="alert" <?php if(empty($errmsg_arr)) echo "style='display:none!important'"; ?>">
          <span><ul>
            <?php
              if(is_array($errmsg_arr) && count($errmsg_arr) > 0 ){
                foreach($errmsg_arr as $msg) {
                  echo '<li>',$msg,'</li>';
                }
              }
            ?>
          </ul></span>
        </div>

        <div class="form-group">
          <button class="btn btn-primary btn-block" type="submit">Log In</button>
        </div><a href="#" class="forgot">Forgot your email or password?</a>

      </form>

    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>

</html>
