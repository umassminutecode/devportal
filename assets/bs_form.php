<?php

//TODO: Add fieldset, textarea, progress and other bits and bobs
//FIXME: make this a class so that I can not have to 

function start_form($method, $id, $style, $heading, $progress = -1, $attr_ar = array()){
    //Column Sizing
    echo "<div class=\"
    
    col-xs-10 col-xs-offset-1
    col-sm-6 col-sm-offset-3
    col-lg-4 col-lg-offset-4
    gen-form
    
    \">";

    //pass_js($id);

    echo "<h2 class=\"text-center form-heading\">$heading</h2>";

    if($progress > -1){
        echo "
        <div class=\"progress\">
            <div class=\"progress-bar\" aria-valuenow=\"$progress\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $progress%;\">$progress%</div>
        </div>
        ";
    }

    $str = "<form method=\"$method\" action=\"function-$id\" id=\"$id\" class=\"$style custom-gen-form\" ";
        $str .= $attr_ar ? addAttributes( $attr_ar ) . '>' : '>';
    
    echo $str;
}

function add_input($type, $label, $name, $value, $feedback = False, $attr_ar = array()){

    $str = "<div class=\"form-group has-feedback\">";
        $str .= "<div class=\"col-lg-4 col-md-3 col-sm-4\">";
            $str .= "<label for=\"$name\" class=\"control-label\">$label</label>";
        $str .= "</div>";

        $str .= "<div class=\"col-lg-8 col-md-9 col-sm-8\">";

            $str .= "<input type=\"$type\" name=\"$name\" class=\"form-control\" ";
            $str .= $attr_ar ? addAttributes( $attr_ar ) . '/>' : '/>';
            $str .= $feedback ? "<i aria-hidden=\"true\" class=\"form-control-feedback glyphicon glyphicon-star\"></i>" : "";

        $str .= "</div>";
    
    $str .= "</div>";

    echo $str;

}

function add_text($text){
    echo " <p class=\"form-text\">$text</p>";
}

function add_submit($id = "", $label = "Submit"){
    echo "<button class=\"btn btn-default btn-block submit-button\" type=\"submit\">$label</button>";

    //TODO: Pass variables around properly
    //echo "<div id=\"alert-$id\" class=\"alert-box alert alert-success\" role=\"alert\"> <strong>Submitted!</strong> </div>";
}

// function pass_js($id){
//     echo "
    
//     <script>
//         function function-$id(){
//             if (window.XMLHttpRequest) {
//                 // code for IE7+, Firefox, Chrome, Opera, Safari
//                 xmlhttp = new XMLHttpRequest();
//             } else {
//                 // code for IE6, IE5
//                 xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
//             }
//             xmlhttp.onreadystatechange = function() {
//                 if (this.readyState == 4 && this.status == 200) {
//                     document.getElementById(\"alert-$id\").innerHTML = this.responseText;
//                 }
//             };
//             xmlhttp.open(\"GET\",\"getuser.php?q=\"+str,true);
//             xmlhttp.send();
//         }
//         }
//     </script>
    
    
//     ";
// }

function end_form(){
    echo "</form>";
    echo "</div>";
}

function addAttributes( $attr_ar ) {
    $str = '';
    // check minimized (boolean) attributes
    $min_atts = array('checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'); // html5
    
    foreach( $attr_ar as $key=>$val ) {
        if ( in_array($key, $min_atts) ) {
            if ( !empty($val) ) { 
                $str .= "$key";
            }
        } else {
            $str .= " $key=\"$val\"";
        }
    }
    return $str;
}


?>