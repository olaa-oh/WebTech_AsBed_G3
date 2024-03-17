<?php

include '../settings/connection.php';

function all_requests(){
    $query = "SELECT *FROM requests";

    global $con;

    if(!$output = $con->query($query)){
        echo "Failed";
        exit();
    }
    return $output;
}
?>