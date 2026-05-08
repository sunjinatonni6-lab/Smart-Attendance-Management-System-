<?php
include("config/db.php");
$res = $conn->query("SELECT * FROM courses");
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">

<h2>Course List</h2>

    <!-- Back Button -->
    <a href="dashboard.php">
        <button type="button" class="btn home-btn">
            Back to Home
        </button>
    </a>
<a href="add_course.php">Add Course</a>

<table>
<tr>
<th>ID</th>
<th>Course Name</th>
<th>Action</th>
</tr>

<?php while($row = $res->fetch_assoc()){ ?>

<tr>
<td><?php echo $row['course_id']; ?></td>
<td><?php echo $row['course_name']; ?></td>
<td>
<a href="delete_course.php?id=<?php echo $row['course_id']; ?>">Delete</a>
</td>
</tr>

<?php } ?>

</table>

</div>