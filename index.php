<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Devportal</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
  <div class="login-card">

    <?php
      $login = new bs_form("login", "minutecode.org");

      $login->start_form("post", "form-horizontal", "MinuteCode Dev Portal Login");
        $login->add_input("text", "Username: ", "username", "", False);
        $login->add_input("password", "Password: ", "password", "", False);
        $login->add_hidden("login_user", "True");
      $login->end_form();


    ?>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>