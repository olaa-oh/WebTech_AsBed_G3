
<?php

include "../settings/connection.php";
session_start();
$form_output = $_POST;

if(isset($_POST['Srequest'])){
    $subject = $form_output["Trequest"];
    $request = $form_output["Drequest"];
}
else{
    echo '<script>alert("Please, try again.");</script>';
    echo '<script>window.location.href="../view/home.php";</script>';
    exit();
}
$user_id = $_SESSION['user_id'];
$query = "INSERT INTO  Requests(title, request_text, student_id) VALUES ('$subject','$request', '$user_id')";

global $con;

if($con->query($query) ===TRUE){
    echo '<script>alert("Request sent");</script>';}
    else{
        '<script>alert("Error, try again.");</script>';
    }

echo '<script>window.location.href="../view/home.php";</script>';
exit();


?>