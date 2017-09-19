<?php


class bs_box{
    function __construct(){
        //Glboal data

    }

    function boxes_start(){
        echo "<div class=\"bs-boxed\">";
        echo "<div class=\"container\">";
    }

    function row_start(){
        echo "<div class=\"row box-row\">";
    }

    function box_start(){
        echo "<div class=\"col-md-4 col-sm-6 item\">";
        echo "<div class=\"box\">";
    }

    function box_display_headline($headline){
        echo "<h1 class=\"headline\">$headline </h1>";
    }

    function box_display_subheadline($line, $color = "inherit"){
        
        echo "<h2 class=\"subheadline\" style=\"color:$color; \" >$line </h2>";

    }

    function box_display_lineheader($line, $color = "inherit"){
        
        echo "<h3 class=\"lineheader\" style=\"color:$color; \" >~$line~ </h3>";

    }

    function box_display_line($line, $color = "inherit"){

        echo "<p class=\"line\" style=\"color:$color; \" >$line </p>";

    }
    
    function box_display_hr(){
        echo "<hr class=\"hrline\">";
    }

    function project_box_display_links($git, $trello, $todo){
        //<div class="social"><a href="#"><i class="fa fa-trello"></i></a><a href="#"><i class="fa fa-github"></i></a><a href="#"><i class="fa fa-vcard-o"></i></a></div>
    }

    function box_end(){
        echo "</div>";
        echo "</div>";
    }

    function row_end(){
        echo "</div>";
    }

    function boxes_end(){
        echo "</div>";
        echo "</div>";
    }

}


?>