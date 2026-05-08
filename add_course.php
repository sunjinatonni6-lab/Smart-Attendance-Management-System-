<?php
include("config/db.php");

if(isset($_POST['submit'])){

    $course = $_POST['course'];

    $conn->query("INSERT INTO courses(course_name)
    VALUES('$course')");

    header("Location:courses.php");
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">

<h2>Add Course</h2>

<form method="POST">
<input type="text" name="course" placeholder="Course Name" required>
<button name="submit">Add</button>
</form>

</div>