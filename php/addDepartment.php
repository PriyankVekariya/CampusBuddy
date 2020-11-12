<?php
$deptName = $_POST['deptName'];

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  header("Location: ../error.php");
}

$query = "INSERT INTO departments(dept_name) VALUES ('" . $deptName . "')";

$result = $conn->query($query);
$conn->close();

if($result){
    header("Location: ../adminpanel.php");
} else {
    header("Location: ../error.php");
}