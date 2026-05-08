<?php
include("config/db.php");

/* =========================
   DELETE
========================= */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE student_id=$id");
    header("Location: students.php");
    exit();
}

/* =========================
   EDIT FETCH
========================= */
$editMode = false;
$editData = null;

if(isset($_GET['edit'])){
    $editMode = true;
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM students WHERE student_id=$id");
    $editData = $res->fetch_assoc();
}

/* =========================
   ADD / UPDATE
========================= */
if(isset($_POST['save'])){

    $id = $_POST['id'];
    $name = $_POST['name'];

    // UPDATE
    if(isset($_POST['old_id']) && $_POST['old_id'] != ""){
        $old_id = $_POST['old_id'];

        $conn->query("UPDATE students 
                      SET student_id='$id', name='$name' 
                      WHERE student_id=$old_id");
    }
    // INSERT
    else{
        $conn->query("INSERT INTO students(student_id, name) 
                      VALUES('$id', '$name')");
    }

    header("Location: students.php");
    exit();
}

/* =========================
   FETCH ALL
========================= */
$res = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>

    <style>
        body{ font-family: Arial; }

        .container{
            width: 70%;
            margin: 40px auto;
            padding: 20px;
            box-shadow: 0 0 10px #ccc;
            border-radius: 10px;
        }

        form{
            text-align: center;
            margin-bottom: 20px;
        }

        input{
            padding: 8px;
            margin: 5px;
            width: 200px;
        }

        button{
            padding: 8px 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th, td{
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th{
            background: #007bff;
            color: white;
        }

        .edit{
            background: orange;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete{
            background: red;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

<h2 style="text-align:center;">Student List </h2>
    <!-- Back Button -->
    <a href="dashboard.php">
        <button type="button" class="home-btn">
            Back to Home
        </button>
    </a>
<!-- FORM -->
<form method="POST">

    <input type="hidden" name="old_id"
           value="<?php echo $editMode ? $editData['student_id'] : ''; ?>">

    <input type="number" name="id"
           placeholder="Student ID"
           value="<?php echo $editMode ? $editData['student_id'] : ''; ?>"
           required>

    <input type="text" name="name"
           placeholder="Student Name"
           value="<?php echo $editMode ? $editData['name'] : ''; ?>"
           required>

    <button type="submit" name="save">
        <?php echo $editMode ? "Update" : "Add"; ?>
    </button>

</form>

<!-- TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Action</th>
</tr>

<?php while($row = $res->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['student_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td>

        <a class="edit"
           href="students.php?edit=<?php echo $row['student_id']; ?>">
           Edit
        </a>

        <a class="delete"
           href="students.php?delete=<?php echo $row['student_id']; ?>"
           onclick="return confirm('Delete this student?')">
           Delete
        </a>

    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>