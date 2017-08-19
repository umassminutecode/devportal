<?php

require("connection.php"); //Creats $conn with db connection

function query_db($query){
	return mysqli_query($conn, $query);
}

function next_result($result){
    return mysqli_fetch_assoc($result);
}

function has_privilege($uid, $cat, $key, $target, $mode){
    $query = "SELECT user_privileges.uid, privilege_keys.cat, privilege_keys.key_char, user_privileges.key_value
              FROM user_privileges
              INNER JOIN privilege_keys ON user_privileges.key_id = privilege_keys.id
              WHERE user_privileges.uid = '$uid'";

    $result = next_result(query_db($query));

    if($cat != $result['cat'] || $key != $result['key_char'])
        return false;

    switch ($mode) {
        case $MODE_EQUALS:
            if ($result['key_value'] == $target)
                return true; 
            break;

        case $MODE_LESS:
            if ($result['key_value'] < $target)
                return true; 
            break;

        case $MODE_GREATER:
             if ($result['key_value'] > $target)
                return true; 
            break;
        
        default:
            return NULL;
            break;
    }

    
}


####### has_privilege MODES
    $MODE_EQUALS = 0;
    $MODE_LESS = 1;
    $MODE_GREATER = 2;



?>