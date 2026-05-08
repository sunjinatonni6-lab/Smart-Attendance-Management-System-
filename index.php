<?php
session_start();
include("config/db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

    if($res->num_rows > 0){
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
    }
    else{
        echo "Invalid Login";
    }
}
?>

<link rel="stylesheet" href="assets/style.css">

<div class="container">

<h1>Smart Attendance System</h1>

<form method="POST">

<input type="email" name="email" placeholder="Email" required><br>

<input type="password" name="password" placeholder="Password" required><br>

<button name="login">Login</button>

</form>

</div>