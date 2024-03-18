<?php

include '../settings/connection.php';

function all_halls(){
    $query = "SELECT * FROM Halls";

    global $con;

    if(!$output = $con->query($query)){
        echo "Failed";
        exit();
    }
    return $output;
}
?>