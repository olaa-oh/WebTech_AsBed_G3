<?php

include_once("../settings/connection.php");

// Function to retrieve hall information
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

// Function to retrieve hall rooms and their members
function getHallRoomsAndMembers($hall_id) {
    global $con;

    // Prepare the query to retrieve hall rooms
    $get_rooms = $con->prepare("SELECT * FROM Rooms WHERE hall_id = ?");
    $get_rooms->bind_param("i", $hall_id);
    $get_rooms->execute();
    $result_rooms = $get_rooms->get_result();

    $hall_rooms = array();

    if ($result_rooms->num_rows > 0) {
        // Fetch all hall rooms
        while ($room = $result_rooms->fetch_assoc()) {
            // Prepare the query to retrieve room members for each hall room
            $get_room_members = $con->prepare("SELECT * FROM RoomBookings WHERE room_id = ?");
            $get_room_members->bind_param("i", $room['room_id']);
            $get_room_members->execute();
            $result_members = $get_room_members->get_result();

            $room_members = array();

            // Fetch all room members
            while ($member = $result_members->fetch_assoc()) {
                // retrieve member's name
                $get_user = $con->prepare("SELECT * FROM Users WHERE user_id = ?");
                $get_user->bind_param("i", $member["user_id"]);
                $get_user->execute();
                $user_result = $get_user->get_result();
                $user_details = $user_result->fetch_assoc();

                // Add username to member from user_details
                $member['username'] = $user_details['username'];

                // Add username to member from user_details
                $room_members[] = $member;
            }

            // Add room and its members to the hall rooms array
            $room['members'] = $room_members;
            $hall_rooms[] = $room;
        }

    }

    return $hall_rooms;
}

// Check if 'id' parameter is provided in the URL
if(isset($_GET['id'])) {
    $hall_id = $_GET['id'];

    // Get hall information
    $hall_info = getHall($hall_id);

    // Get hall rooms and their members
    $hall_rooms_and_members = getHallRoomsAndMembers($hall_id);

    // Combine hall information and hall rooms data
    $response_data = array(
        'hall_info' => $hall_info,
        'hall_rooms_and_members' => $hall_rooms_and_members
    );

    // Encode the combined data as JSON and return it
    header('Content-Type: application/json');
    echo json_encode($response_data);
} else {
    // Return an error message if 'id' parameter is not provided
    echo json_encode(array('error' => 'No hall ID provided'));
}

?>