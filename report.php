<?php
include 'config/db.php';

// Fetch all courses
$courses = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <link rel="stylesheet" href="assets/style.css">

    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container{
            width: 80%;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
        }

        form{
            margin-bottom: 20px;
        }

        select,
        input[type="date"]{
            padding: 10px;
            width: 220px;
            margin-right: 10px;
        }

        button{
            padding: 10px 18px;
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover{
            background: #0056b3;
        }

        .home-btn{
            background: #28a745;
            margin-bottom: 20px;
        }

        .home-btn:hover{
            background: #1e7e34;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td{
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        table th{
            background: #007bff;
            color: white;
        }

        .present{
            color: green;
            font-weight: bold;
        }

        .absent{
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Attendance Report</h2>

    <!-- Back Button -->
    <a href="dashboard.php">
        <button type="button" class="home-btn">
            Back to Home
        </button>
    </a>

    <form method="GET">

        <select name="course" required>

            <option value="">Select Course</option>

            <?php while($c = $courses->fetch_assoc()){ ?>

                <option value="<?php echo $c['course_id']; ?>">
                    <?php echo $c['course_name']; ?>
                </option>

            <?php } ?>

        </select>

        <input type="date" name="date" required>

        <button type="submit">View Report</button>

    </form>

<?php

if(isset($_GET['course']) && isset($_GET['date'])){

    $course = $_GET['course'];
    $date = $_GET['date'];

    $query = "SELECT students.student_id,
                     students.name,
                     attendance.status
              FROM attendance
              JOIN students
              ON attendance.student_id = students.student_id
              WHERE attendance.course_id='$course'
              AND attendance.date='$date'";

    $res = $conn->query($query);

    if($res->num_rows > 0){

        echo "<table>";

        echo "<tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Status</th>
              </tr>";

        while($row = $res->fetch_assoc()){

            $statusClass = ($row['status'] == 'Present') ? 'present' : 'absent';

            echo "<tr>
                    <td>{$row['student_id']}</td>
                    <td>{$row['name']}</td>
                    <td class='$statusClass'>{$row['status']}</td>
                  </tr>";
        }

        echo "</table>";

    } else {

        echo "<p style='color:red; margin-top:20px;'>
                No attendance record found!
              </p>";
    }
}
?>

</div>

</body>
</html>