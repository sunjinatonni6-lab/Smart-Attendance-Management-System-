<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location:index.php");
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">

<h1>Dashboard</h1>

<ul>
    <li><a href="students.php">Student List</a></li>
    <li><a href="courses.php">Course List</a></li>
    <li><a href="mark_attendance.php">Mark Attendance</a></li>
    <li><a href="report.php">Attendance Report</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</div>