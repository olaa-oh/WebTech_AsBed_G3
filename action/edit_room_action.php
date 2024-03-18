<?php
// Include the connection file
include '../settings/connection.php';
include '../functions/get_hall_id_fxn.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $roomId = $_POST['roomId'];
    $roomName = $_POST['editRoomName'];
    $roomCapacity = $_POST['editRoomCapacity'];

    // Prepare update query
    $updateQuery = "UPDATE Rooms SET room_name = '$roomName', capacity = '$roomCapacity' WHERE room_id = '$roomId'";

    // Execute the update query
    if ($con->query($updateQuery) === TRUE) {
        // Redirect to halls.php after successful update
        header("Location: ../admin/hall.php");
        exit();
    } else {
        // Handle error if the update fails
        echo "Error updating room: " . $con->error;
    }
} else {
    // Redirect to error page if the form is not submitted
    header("Location: ../admin/halls.php?error=update_failed");
    exit();
}
?>
