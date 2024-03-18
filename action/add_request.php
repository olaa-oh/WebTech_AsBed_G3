
<?php

include "../settings/connection.php";

$form_output = $_POST;

if(isset($_POST['Srequest'])){
    $subject = $form_output["Trequest"];
    $request = $form_output["Drequest"];
}
else{
    echo '<script>alert("Please, try again.");</script>';
    echo '<script>window.location.href="../view/studentPortal.php";</script>';
    exit();
}
$query = "INSERT INTO   Requests(title, request_text) VALUES ('$subject','$request')";

global $con;

if($con->query($query) ===TRUE){
    echo '<script>alert("Request sent");</script>';}
    else{
        '<script>alert("Error, try again.");</script>';
    }

echo '<script>window.location.href="../view/studentPortal.php";</script>';
exit();


?>