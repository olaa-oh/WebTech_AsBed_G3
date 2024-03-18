<?php

include_once '../settings/connection.php';

global $query;
global $con;

if(isset($_GET['id'])){
    $r_id = $_GET['id'];
    $query = "DELETE FROM requests WHERE request_id = $r_id ";
    $choreSubject = "SELECT title FROM requests WHERE request_id = $r_id ";


    //
    if($con->query($choreSubject)){
        $output = $con->query($choreSubject);

        $row = $output->fetch_assoc();

        $subReq = $row['title'];

        $con->query($query);

        echo '<script>alert("'.$subReq.' Deleted!");</script>';
        echo '<script>window.location.href="../view/home.php";</script>';
    }
}
else {
    echo "end";
    echo $query.$con->error;
    exit();
}


?>