<?php

class bs_tabs{

    protected $tabcount = 1;

    function __construct(){

    }

    function start_tabs($headers = array()){
        echo "<div>";
        echo "<ul class=\"nav nav-tabs\">";
        $i = 1;
        foreach($headers as &$header){
            echo "<li><a href=\"#tab-$i\" role=\"tab\" data-toggle=\"tab\">$header</a></li>";
            $i++;
        }
        echo "</ul>";
        echo "<div class=\"tab-content\">";
    }

    function start_tab(){
        echo "<div role=\"tabpanel\" class=\"tab-pane\" id=\"tab-$tabcount\">";
    }

    
    function end_tab(){
        echo "</div>";
        $tabcount++;
    }

    function end_tabs(){
        echo "</div>";
        echo "</div>";
    }
    
}

?>