<?php
include("config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM students WHERE student_id='$id'");

header("Location:students.php");
?>