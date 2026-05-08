<?php
include 'config/db.php';

/* Fetch Courses */
$courses = $conn->query("SELECT * FROM courses");

/* Fetch Students */
$students = $conn->query("SELECT * FROM students");

/* Save Attendance */
if(isset($_POST['submit'])){

    $course = $_POST['course'];
    $date = $_POST['date'];

    foreach($_POST['status'] as $student_id => $status){

        // আগে আগের data delete
        $conn->query("DELETE FROM attendance 
                      WHERE student_id='$student_id' 
                      AND course_id='$course' 
                      AND date='$date'");

        // নতুন data insert
        $conn->query("INSERT INTO attendance(student_id, course_id, date, status)
        VALUES('$student_id', '$course', '$date', '$status')");
    }

    echo "<h3 style='color:green;text-align:center;'>Attendance Saved Successfully</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="assets/style.css">

    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
        }

        .container{
            width:70%;
            margin:auto;
            background:white;
            padding:20px;
            margin-top:40px;
            border-radius:10px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid #ccc;
        }

        th, td{
            padding:10px;
            text-align:center;
        }

        select, input{
            padding:8px;
            margin-top:10px;
        }

        button{
            padding:10px 20px;
            background:green;
            color:white;
            border:none;
            margin-top:20px;
            cursor:pointer;
        }

        button:hover{
            background:darkgreen;
        }

        .back-btn{
            background: #007bff;
            padding:10px 20px;
            color:white;
            border:none;
            cursor:pointer;
            margin-bottom:10px;
        }

        .back-btn:hover{
            background:black;
        }
    </style>

</head>

<body>

<div class="container">

<h2>Mark Attendance</h2>

<!-- Back Button -->
<a href="dashboard.php">
    <button type="button" class="back-btn">
        Back to Home
    </button>
</a>

<form method="POST">

    <label>Select Course:</label>
    <select name="course" required>
        <?php while($c = $courses->fetch_assoc()){ ?>
            <option value="<?php echo $c['course_id']; ?>">
                <?php echo $c['course_name']; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Select Date:</label>
    <input type="date" name="date" required>

    <table>
        <tr>
            <th>Student Name</th>
            <th>Status</th>
        </tr>

        <?php while($s = $students->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $s['name']; ?></td>

            <td>
                <select name="status[<?php echo $s['student_id']; ?>]">
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>
            </td>
        </tr>
        <?php } ?>
    </table>

    <button type="submit" name="submit">
        Save Attendance
    </button>

</form>

</div>

</body>
</html>