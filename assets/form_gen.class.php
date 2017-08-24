<?php

/* 
    PHP Form Class from Dynamic Web Coding at dyn-web.com
    Copyright 2001-2013 by Sharon Paine
    For demos, documentation and updates, visit http://www.dyn-web.com/code/form_builder/

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// version date: May 2013

class form_gen {
    
    private $tag;
    private $xhtml;
    
    function __construct($xhtml = true) {
        $this->xhtml = $xhtml;
    }
    
    function startForm($action = '#', $method = 'post', $id = '', $class = '', $attr_ar = array() ) {
        $str = "<form action=\"$action\" method=\"$method\"";
        if ( !empty($id) ) {
            $str .= " id=\"$id\"";
        }
        if ( !empty($class) ) {
            $str .= " class=\"$class\"";
        }
        $str .= $attr_ar? $this->addAttributes( $attr_ar ) . '>': '>';
        return $str;
    }
    
    private function addAttributes( $attr_ar ) {
        $str = '';
        // check minimized (boolean) attributes
        $min_atts = array('checked', 'disabled', 'readonly', 'multiple',
                'required', 'autofocus', 'novalidate', 'formnovalidate'); // html5
        foreach( $attr_ar as $key=>$val ) {
            if ( in_array($key, $min_atts) ) {
                if ( !empty($val) ) { 
                    $str .= $this->xhtml? " $key=\"$key\"": " $key";
                }
            } else {
                $str .= " $key=\"$val\"";
            }
        }
        return $str;
    }
    
    function addInput($type, $name, $value, $attr_ar = array() ) {
        $str = "<input class=\".form-control\" type=\"$type\" name=\"$name\" value=\"$value\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        return $str;
    }

    //BOOTSTRAP SUPPORT 
    function addInputWithLabel($label, $type, $name, $value, $attr_ar = array() ) {
        $str = "<div class=\"form-group\">";
        $str .= "<label class=\"control-label col-sm-2\" for=\"$name\"> $label </label>";
        $str .= "<div class=\"col-sm-10\">";
        $str .= "<input class=\".form-control\" type=\"$type\" name=\"$name\" value=\"$value\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        $str .= "</div>";
        $str .= "</div>";
        return $str;
    }
    
    function addTextarea($name, $rows = 4, $cols = 30, $value = '', $attr_ar = array() ) {
        $str = "<textarea class=\".form-control\" name=\"$name\" rows=\"$rows\" cols=\"$cols\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">$value</textarea>";
        return $str;
    }
    
    # NOT SUPPORTED FOR BOOTSTRAP

    // for attribute refers to id of associated form element
    // function addLabelFor($forID, $text, $attr_ar = array() ) {
    //     $str = "<label for=\"$forID\"";
    //     if ($attr_ar) {
    //         $str .= $this->addAttributes( $attr_ar );
    //     }
    //     $str .= ">$text</label>";
    //     return $str;
    // }
    
    // from parallel arrays for option values and text
    function addSelectListArrays($name, $val_list, $txt_list, $selected_value = NULL,
            $header = NULL, $attr_ar = array() ) {
        $option_list = array_combine( $val_list, $txt_list );
        $str = $this->addSelectList($name, $option_list, true, $selected_value, $header, $attr_ar );
        return $str;
    }
    
    // option values and text come from one array (can be assoc)
    // $bVal false if text serves as value (no value attr)
    function addSelectList($name, $option_list, $bVal = true, $selected_value = NULL,
            $header = NULL, $attr_ar = array() ) {
        $str = "<select name=\"$name\"";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= ">\n";
        if ( isset($header) ) {
            $str .= "  <option value=\"\">$header</option>\n";
        }
        foreach ( $option_list as $val => $text ) {
            $str .= $bVal? "  <option value=\"$val\"": "  <option";
            if ( isset($selected_value) && ( $selected_value === $val || $selected_value === $text) ) {
                $str .= $this->xhtml? ' selected="selected"': ' selected';
            }
            $str .= ">$text</option>\n";
        }
        $str .= "</select>";
        return $str;
    }
    
    function endForm() {
        return "</form>";
    }
    
    function startTag($tag, $attr_ar = array() ) {
        $this->tag = $tag;
        $str = "<$tag";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= '>';
        return $str;
    }
    
    function endTag($tag = '') {
        $str = $tag? "</$tag>": "</$this->tag>";
        $this->tag = '';
        return $str;
    }
    
    function addEmptyTag($tag, $attr_ar = array() ) {
        $str = "<$tag";
        if ($attr_ar) {
            $str .= $this->addAttributes( $attr_ar );
        }
        $str .= $this->xhtml? ' />': '>';
        return $str;
    }
    
}

?>






































<form action="#" class="form-horizontal" method="post">

    <div class="form-group has-feedback">
        <div class="col-md-2 col-sm-4">
            <label for="username" class="control-label">Username </label>
        </div>
        <div class="col-md-10 col-sm-8">
            <input type="email" name="username" autofocus autocomplete="off" class="form-control" required />
            <i aria-hidden="true" class="form-control-feedback glyphicon glyphicon-star"></i>
        </div>
    </div>

    <div class="form-group has-feedback">
        <div class="col-md-2 col-sm-4">
            <label class="control-label">Label</label>
        </div>
        <div class="col-md-10 col-sm-8">
            <input type="email" class="form-control" />
            <p class="help-block">Help text for a form field.</p><i aria-hidden="true" class="form-control-feedback glyphicon glyphicon-star"></i></div>
    </div>

    <fieldset>
        <legend>Field Group</legend>
    </fieldset>

    <div class="form-group has-feedback">
        <div class="col-md-2 col-sm-4">
            <label class="control-label">Label</label>
        </div>
        <div class="col-md-10 col-sm-8">
            <textarea class="form-control"></textarea><i aria-hidden="true" class="form-control-feedback glyphicon glyphicon-star"></i></div>
    </div>
</form>

