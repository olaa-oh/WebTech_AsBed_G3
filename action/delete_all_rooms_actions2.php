<?php
// Include the connection file
include '../settings/connection.php';



    // Fetch all room IDs in the specified hall
    $roomIdsQuery = "SELECT room_id FROM Rooms WHERE hall_id = $hall_id";
    $roomIdsResult = $con->query($roomIdsQuery);

    // Array to store room IDs
    $roomIds = [];
    if($roomIdsResult->num_rows > 0) {
        while($row = $roomIdsResult->fetch_assoc()) {
            $roomIds[] = $row['room_id'];
        }
    }

    // Loop through room IDs to update Users table and delete RoomBookings entries
    foreach($roomIds as $roomId) {
        // Update Users table to set has_room to FALSE for users in this room
        $updateQuery = "UPDATE Users SET has_room = FALSE WHERE user_id IN (SELECT user_id FROM RoomBookings WHERE room_id = $roomId)";
        $con->query($updateQuery);

        // Delete room bookings from the RoomBookings table
        $deleteBookingsQuery = "DELETE FROM RoomBookings WHERE room_id = $roomId";
        $con->query($deleteBookingsQuery);
    }

    // Delete all rooms with the specified hall ID
    $deleteRoomsQuery = "DELETE FROM Rooms WHERE hall_id = $hall_id";
    $con->query($deleteRoomsQuery);

    // Redirect back to the previous page or any desired location
    // header("Location: ../admin/hall.php?message=successful");
    // exit();
    // echo 'successful';

?>
