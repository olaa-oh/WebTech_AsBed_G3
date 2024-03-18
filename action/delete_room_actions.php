<?php
// Include the connection file
include '../settings/connection.php';

if(isset($_GET['room_id'])) {
    // Get the room ID from the URL parameter
    $room_id = $_GET['room_id'];

    // Update Users table to set has_room to FALSE for users in this room
    $updateQuery = "UPDATE Users SET has_room = FALSE WHERE user_id IN (SELECT user_id FROM RoomBookings WHERE room_id = $room_id)";
    $con->query($updateQuery);

    // Delete the room from the Rooms table
    $deleteRoomQuery = "DELETE FROM Rooms WHERE room_id = $room_id";
    $con->query($deleteRoomQuery);

    // Delete the room bookings from the RoomBookings table
    $deleteBookingsQuery = "DELETE FROM RoomBookings WHERE room_id = $room_id";
    $con->query($deleteBookingsQuery);
    // Redirect back to the previous page or any desired location
    header("Location: ../admin/hall.php?message=successful");
    exit();
} else {
    // If the room ID is not provided, redirect to an error page or any desired location
    header("Location: ../admin/hall.php?message=unsuccessful");
    exit();
}
?>
