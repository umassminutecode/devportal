<?php 

    $ASSETS_FOLDER = "assets/";
    $PAGE_KEY = "";
    $PAGE_TARGET = "";
    $HIDE_HEADER = True;

    require($ASSETS_FOLDER."header.php");



?>

  <div class="login-card">

    <?php

      $login = new bs_form("login", "minutecode.org/assets/auth.php");

      $login->start_form("post", "form-horizontal", "MinuteCode Dev Portal Login");
        $login->add_input("text", "Username: ", "username", "", False);
        $login->add_input("password", "Password: ", "password", "", False);
      $login->end_form();


    ?>

  </div>


<?php 

require($ASSETS_FOLDER."footer.php");

?>
