<?php
// Include the connection file
include '../settings/connection.php';
include '../functions/get_hall_id_fxn.php';
include 'delete_all_rooms_action.php';

$hall_id=search_hall_id( $_GET['hall_name'],  $_GET['capacity']);
// Check if hall_id is provided in the request
if(isset($hall_id)) {
    // Sanitize and store the hall_id
    $hall_id = mysqli_real_escape_string($con, $hall_id);

    // Delete all rooms associated with the hall_id
    $deleteRoomsQuery = "DELETE FROM Rooms WHERE hall_id = '$hall_id'";
    if(mysqli_query($con, $deleteRoomsQuery)) {
        // Rooms deleted successfully, now delete the hall
        $deleteHallQuery = "DELETE FROM Halls WHERE hall_id = '$hall_id'";
        if(mysqli_query($con, $deleteHallQuery)) {
            // Hall and associated rooms deleted successfully
            echo "Hall and associated rooms deleted successfully.";
            header("Location: ../admin/halls.php?success=hall_deleted");
        } else {
            // Error deleting hall
            echo "Error deleting hall: " . mysqli_error($con);
        }
    } else {
        // Error deleting rooms
        echo "Error deleting rooms: " . mysqli_error($con);
    }
} else {
    // hall_id not provided in the request
    echo "hall_id not provided.";
}
?>
