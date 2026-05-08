<?php
include("config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM courses WHERE course_id='$id'");

header("Location:courses.php");
?>