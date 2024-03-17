<?php

include_once('../settings/connection.php');

function getRequests($id){
    global $con;
    $query = "SELECT * FROM Requests where request_id = $id";
    if($output = $con->query($query)){
        if($output->num_rows>0)
        return $output;
    
    }
    return $output;
}


?>