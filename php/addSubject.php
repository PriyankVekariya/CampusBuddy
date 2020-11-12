<?php
$deptId = $_POST['deptId'];
$subjectName = $_POST['subName'];

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  header("Location: ../error.php");
}

$query = "INSERT INTO subjects(dept_id, subject_name) VALUES (" . $deptId . ", '" . $subjectName . "')";

$result = $conn->query($query);
$conn->close();

if($result){
    header("Location: ../adminpanel.php");
} else {
    header("Location: ../error.php");
}