<?php

//TODO: Add fieldset, textarea and other bits and bobs
//FIXME: make this a class so that I can not have to 

class bs_form{

    protected $id;
    protected $kickback_location;
    protected $submit;

    function __construct($id, $kickback_location){
        $this->id = $id;
        $this->kickback_location = "http://".$kickback_location;
        $this->submit = "Submit";
    }

    function start_form($method, $style, $heading, $progress = -1, $class_ovr = "col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4"){
        //Column Sizing
        echo "<div class=\"
        
        $class_ovr
        gen-form
        
        \">";

        echo "<h2 class=\"text-center form-heading\">$heading</h2>";

        if($progress > -1){
            echo "
            <div class=\"progress\">
                <div class=\"progress-bar\" aria-valuenow=\"$progress\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $progress%;\">$progress%</div>
            </div>
            ";
        }

        $str = "<form method=\"$method\" action=\"$this->kickback_location\" id=\"$this->id\" class=\"$style custom-gen-form\" ";
            $str .= $attr_ar ? addAttributes( $attr_ar ) . '>' : '>';
        
        echo $str;

        $this->add_alert_feedback($this->id);
    }

    function add_select($label, $name, $value, $feedback = False, $readonly = False, $options = array(), $attr_ar = array()){

        if($feedback == True)
            $feedback = "has-feedback";
        else
            unset($feedback);


        $str = "<div class=\"form-group $feedback \">";
            $str .= "<div class=\"col-lg-4 col-md-3 col-sm-4\">";
                $str .= "<label for=\"$name\" class=\"control-label\">$label</label>";
            $str .= "</div>";

            $str .= "<div class=\"col-lg-8 col-md-9 col-sm-8\">";

                if($readonly == True)
                    $readonly = "readonly";
                else
                    unset($readonly);

                $str .= "<select name=\"$name\" id=\"$name\" class=\"form-control\" value=\"$value\" $readonly >";
                foreach($options as $option){
                    $str .= "<option value=\"$option\">$option</option>";
                }
                $str .= "</select>";
                $str .= $feedback ? "<i aria-hidden=\"true\" class=\"form-control-feedback glyphicon glyphicon-star\"></i>" : "";

            $str .= "</div>";
        
        $str .= "</div>";

        echo $str;

    }

    function add_input($type, $label, $name, $value, $feedback = False, $readonly = False, $attr_ar = array()){
        
        if($feedback == True)
            $feedback = "has-feedback";
        else
            unset($feedback);

        $str = "<div class=\"form-group $feedback\">";
            $str .= "<div class=\"col-lg-4 col-md-3 col-sm-4\">";
                $str .= "<label for=\"$name\" class=\"control-label\">$label</label>";
            $str .= "</div>";

            $str .= "<div class=\"col-lg-8 col-md-9 col-sm-8\">";

                if($readonly == True)
                    $readonly = "readonly";
                else
                    unset($readonly);

                $str .= "<input type=\"$type\" name=\"$name\" id=\"$name\" class=\"form-control\" value=\"$value\" $readonly />";
                //$str .= $attr_ar " . ? addAttributes( $attr_ar ) . '/>' : '/>';
                $str .= $feedback ? "<i aria-hidden=\"true\" class=\"form-control-feedback glyphicon glyphicon-star\"></i>" : "";

            $str .= "</div>";
        
        $str .= "</div>";

        echo $str;

    }

    function add_hidden($name, $value){
        echo "<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
    }

    function add_text($text){
        echo "<p class=\"form-text\">$text</p>";
    }

    function add_submit(){
        echo "<button class=\"btn btn-default btn-block submit-button\" type=\"submit\">$this->submit</button>";
    }

    function add_alert_feedback($form_id){
        if(isset($_SESSION["form-$form_id-color"])){
            echo "<div class=\"alert ".$_SESSION["form-$form_id-color"]."\" role=\"alert\"><span>".$_SESSION["form-$form_id-msg"]."</span></div>";
        }
        unset($_SESSION["form-$form_id-color"], $_SESSION["form-$form_id-msg"]);
    }

    function check_input($field){
        if($_POST[$field] == ""){
            $this->form_kickback("alert-warning", "Please enter a $field and retry.");
        }
    }

    function check_if_field_exist_in_table($table, $field){
        if(num_rows("SELECT * FROM $table WHERE $field=".$_POST[$field]) > 0){
            $this->form_kickback("alert-danger", "This $field already exists. Please try again.");
        }
    }

    function form_kickback($color, $msg){
        $_SESSION["form-$this->id-color"] = $color;
        $_SESSION["form-$this->id-msg"] = $msg;
        ob_end_clean();
        header("Location: ".$this->kickback_location);
        exit();
        
    }

    function ovveride_submit($submit){
        $this->submit = $submit;
    }

    function end_form(){
        $this->add_hidden("form", $this->id);
        $this->add_submit();
        echo "</form>";
        echo "</div>";
    }

    function process_form(){
        return (isset($_POST["form"]) && $_POST["form"] == $this->id);
    }

    function check_pswd(){
        //TODO: PSSWD REquirements

        if($_POST["pswd"] != $_POST["pswdc"]){
            $this->form_kickback("alert-danger", "Passwords do not match.");
        }


    }

    //FIXME: NOT WORKING
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

}

?>