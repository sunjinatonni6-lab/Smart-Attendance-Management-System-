<?php
$conn = new mysqli("localhost","root","","attendance_system2");

if($conn->connect_error){
    die("Connection Failed");
}
?>