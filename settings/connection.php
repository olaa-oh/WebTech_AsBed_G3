<?php
// Define constants to store the database connection parameters
$SERVER= 'localhost';
$USERNAME= 'root';
$PASSWORD= "";
$DATABASE='ALEA2025';

$con =new mysqli($SERVER,$USERNAME,$PASSWORD,$DATABASE) or die("The database was not created");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>

