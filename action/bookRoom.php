<?php
// start a new session
session_start();

// include db connection
include_once("../settings/connection.php");

// ensure the user is logged in
if (!(isset($_SESSION["user_id"]))) {
    // redirect the user to the login page
    header("Location: ../login/login_view.php");
    exit();
}

// get the room id from the request url
if (isset($_GET["room_id"])) {
    $room_id = $_GET["room_id"];
    
    // withdraw user from room if already in another room
    $delete_booking = $con->prepare("DELETE FROM RoomBookings WHERE user_id = ?");
    $delete_booking->bind_param("i", $_SESSION["user_id"]);
    $delete_booking->execute();

    // ensure the room is not full
    

    // insert new room into db
    $book_room = $con->prepare("INSERT INTO RoomBookings (room_id, user_id) VALUES (?, ?)");
    $book_room->bind_param("ii", $room_id, $_SESSION["user_id"]);
    $book_room->execute();
    
    // redirect to Student Portal Page
    header("Location: ../view/studentPortal.php");

} else {
    // redirect to student portal page
    header("Location: ../view/studentPortal.php");
    exit();
}
 ?>