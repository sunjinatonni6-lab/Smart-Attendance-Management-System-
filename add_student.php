<?php
include("config/db.php");

if(isset($_POST['submit'])){

    $name = $_POST['name'];

    $conn->query("INSERT INTO students(name)
    VALUES('$name')");

    header("Location:students.php");
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">

<h2>Add Student</h2>

<form method="POST">
<input type="text" name="name" placeholder="Student Name" required>
<button name="submit">Add</button>
</form>

</div>