<?php

require("connection.php"); //Creats $conn with db connection
$dev = True;

function query_db($query){
    global $conn;
	return mysqli_query($conn, $query);
}

function next_result($result){
    return mysqli_fetch_assoc($result);
}

function has_privilege($uid, $cat, $key, $target){

    $query = "SELECT user_privileges.uid, privilege_keys.cat, privilege_keys.key_char, user_privileges.key_value, privilege_keys.key_type
              FROM user_privileges
              INNER JOIN privilege_keys ON user_privileges.key_id = privilege_keys.id
              WHERE user_privileges.uid = '$uid'";

    
    $query = query_db($query);
    $i = 0;

    while($result = next_result($query)){

        global $dev;

        if($dev){
            echo "itteration: ".$i;
            $i = $i+1;
            break_line();
            echo "passed:    ".format_key($cat, $key);
            break_line();
            echo "server:    ".format_key($result['cat'], $result['key_char']);
            break_line();
            echo "target: ".$target;
            break_line();
            echo "key_value: ".$result['key_value'];
            break_line();
            break_line();
        }

        if((($cat == $result['cat'] || $result['cat'] == "%") && ($key == $result['key_char'] || $result['key_char'] == "%")) && $result['key_value'] != NULL ){

            // if($result['cat'] == "%" || $result['key_char'] == "%"){
            //     return true;
            // }

            if($result['key_type'] == 'TF'){
                if ($result['key_value'] == $target) return true; 
            }
            else{
                if ($result['key_value'] == 0) return true;
                if ($result['key_value'] == $target) return true; 
            }
        }
    }

    return "False";
}

function format_key($cat, $key){
    return $cat.":".$key;
}
function break_line(){
    echo "</br>";
}


####### has_privilege MODES
    $MODE_EQUALS = 0;
    $MODE_LESS = 1;
    $MODE_GREATER = 2;



?>