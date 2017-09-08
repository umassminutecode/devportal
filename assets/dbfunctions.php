<?php

require("connection.php"); //Creats $conn with db connection
$dev = False;

function query_db($query){
    //echo $query;
    global $conn;
    if($query == "") return Null;
    return mysqli_query($conn, $query);
}

function next_result($result){
    return mysqli_fetch_assoc($result);
}


function query_error(){
    global $conn;
    return mysqli_error($conn);
}

function num_rows($sql){
    $result = query_db($sql);
    if($result == False) return False;
    return mysqli_num_rows($result);
}

function has_privilege($uid, $cat, $key, $target){

    $check = check_key($uid, $cat, $key, $target);
    
    //echo $check==0? "<h1> True </h1>" : "<h1> False </h1>";

    if($check == 0) return false;

    //FIXME: Make the last used actually update
    $time = date("Y-m-d H:i:s"); 
    $query = "UPDATE user_privileges
    SET last_used = `$time
    WHERE id = $check";

    $query = query_db($query);

    return True;
}

function check_key($uid, $cat, $key, $target){
    
    $query = "SELECT user_privileges.uid, privilege_keys.cat, privilege_keys.key_char, user_privileges.key_value, privilege_keys.key_type, user_privileges.id
              FROM user_privileges
              INNER JOIN privilege_keys ON user_privileges.key_id = privilege_keys.id
              WHERE user_privileges.uid = $uid";

    
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

            if($result['key_type'] == 'TF'){
                if ($result['key_value'] == $target) return $result['id']; 
            }
            else{
                if ($result['key_value'] == 0) return $result['id'];
                if ($result['key_value'] == $target) return $result['id']; 
            }
        }
    }

    return 0;
}

function db_table_to_html_table($table_name, $select = "*"){
    $sql = "SELECT $select
              FROM $table_name";
    db_select_to_html_table($table_name, $sql);
}

function db_select_to_html_table($id, $sql){
    
        echo "<<script>
        
            $(document).ready(function() {
                $('#$id').DataTable();
            } );
        
        </script>";
    
        //table declaration
        echo "<table id=".$id." class=\"display\" cellspacing=\"0\" width=\"100%\">";
        
        //Table Body
        $query = query_db($sql);
        $keys = array_keys(next_result($query));
    
        //Table Head
        echo "<thead> <tr>";
        
        foreach ($keys as &$field){
            echo "<td>".$field."</td>";
        }
    
        echo "</thead> </tr>";
    
        unset($query, $field);
    
        $query = query_db($sql);
    
        echo "<tbody>";
        while($result = next_result($query)){
            echo "<tr>";
    
            foreach ($keys as &$field){
                echo "<td>".$result[$field]."</td>";
            }
    
            echo "</tr>";
        }
        echo "</tbody>";
    
    
        echo "</table>";
    }

function format_key($cat, $key){
    return $cat.":".$key;
}
function break_line(){
    echo "</br>";
}

function show($key, $target){

    global $GLOBAL_UID;

    $key_split = explode(":", $key);

    if(!has_privilege($GLOBAL_UID, $key_split[0], $key_split[1], $target)){
        echo "hidden";
        return;
    }
    else{
        return;
    }
}

function show_page($key, $target){
    global $GLOBAL_UID;
    
        $key_split = explode(":", $key);
    
        if(!has_privilege($GLOBAL_UID, $key_split[0], $key_split[1], $target)){
            header( 'Location: http://minutecode.org/dev_home.php' ) ;
            return;
        }
        else{
            return;
        }
}

function get_user_info($uid, $field){
    $sql = "SELECT $field
            FROM user_info
            WHERE user_info.uid = $uid";

    $query = query_db($sql);
    $result = next_result($query);
    return $result["$field"];
}

function get_user_field($uid, $field){
    $sql = "SELECT $field
    FROM users
    WHERE users.uid = $uid";

    $query = query_db($sql);
    $result = next_result($query);
    return $result["$field"];
}

function get_user_name($uid){
    $sql = "SELECT CONCAT(fname, ' ', lname) AS Name
            FROM user_info
            WHERE user_info.uid = $uid";

    $query = query_db($sql);
    $result = next_result($query);
    return $result["Name"];
}

function get_user_username($uid){
    $sql = "SELECT username
            FROM users
            WHERE users.uid = $uid";

    $query = query_db($sql);
    $result = next_result($query);
    return $result["username"];
}

function get_user_uid_from_username($username){
    $sql = "SELECT uid
    FROM users
    WHERE users.username = $username";

    $query = query_db($sql);

    if($query == NULL) return -1;

    $result = next_result($query);
    return $result["uid"];
}

function update_table($tbl, $set, $where){
    $sql = "UPDATE $tbl
            SET $set
            WHERE $where";

    $query = query_db($sql);
}

function update_field($tbl, $field, $value, $where, $equals){
    $sql = "UPDATE $tbl
    SET `$field`=\"$value\"
    WHERE `$where`=\"$equals\" ";

    $query = query_db($sql);
}

function update_timestamp_field($tbl, $field, $where, $equals){
    $sql = "UPDATE $tbl
    SET `$field`= now()
    WHERE `$where`=\"$equals\" ";

    $query = query_db($sql);
}

function insert_into_table($tbl, $columns, $values = array()){
    $colstr = "(";
    foreach($columns as $col){
        if($col != $columns[0]) $colstr .= ",";
        $colstr .= "`".$col."`";
    }
    $colstr .= ")";

    $valstr = "(";
    foreach($values as $val){
        if($val != $values[0]) $valstr .= ",";
        $valstr .= "\"".$val."\"";
    }
    $valstr .= ")";
    
    $sql = "INSERT INTO $tbl $colstr
            VALUES $valstr";

    $query = query_db($sql);
    return $sql;
}


####### has_privilege MODES
    $MODE_EQUALS = 0;
    $MODE_LESS = 1;
    $MODE_GREATER = 2;
?>