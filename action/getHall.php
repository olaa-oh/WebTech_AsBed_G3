<?php

include '../settings/connection.php';

function getHall($id){
    global $con;
    $query = $con->prepare("SELECT * FROM Halls WHERE hall_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();

    // Fetch all rows as associative array
    $hall_info = array();
    while ($row = $result->fetch_assoc()) {
        $hall_info[] = $row;
    }

    return $hall_info;
}

// check if 'id' parameter is provided in the URL
if(isset($_GET['id'])) {
    $hall_id = $_GET['id'];
    $hall_info = getHall($hall_id);
    
    // encode the result as JSON and return it
    header('Content-Type: application/json');
    echo json_encode($hall_info);
} else {
    // return an error message if 'id' parameter is not provided
    echo json_encode(array('error' => 'No hall ID provided'));
}
?>