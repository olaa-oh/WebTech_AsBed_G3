<?php

include_once("../settings/connection.php");

function getRoomNumber($user_id) {
    global $con;

    // retrieve room number and hall name for the user if exists
    $query = "SELECT Rooms.room_name, Halls.hall_name
          FROM Rooms
          JOIN Halls ON Rooms.hall_id = halls.hall_id
          WHERE Rooms.room_id IN (SELECT room_id FROM roombookings WHERE user_id = ?)";

    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // fetch associated array
        while ($row = $result->fetch_assoc()) {
            $room_name = $row['room_name'];
            $hall_name = $row['hall_name'];

            return [$room_name, $hall_name];
        }
    } else {
        return -1;
    }
}
?>