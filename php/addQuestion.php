<?php
$userId = $_COOKIE["ID"];
$subId = $_POST['subId'];
$title = $_POST['title'];
$questionText =$_POST['questionText'];

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    header("Location: ../error.php");
}

$query = "INSERT INTO temp_questions(user_id, subject_id, title, question_description) VALUES (" . $userId . ", " . $subId . ", '" . $title . "', '" . $questionText . "')";
$message = "Your question is submitted successfully having title as " . $title .".";
$notification = "INSERT INTO notifications(user_id, message) VALUES(" . $userId . ", '" . $message . "')";
$deleteNotification = "DELETE FROM notifications WHERE timestamp < now() - interval 1 day";
$deletionResult = $conn->query($deleteNotification);

$result = $conn->query($query);

if($result){
    $notificationResult = $conn->query($notification);
    $conn->close();
    header("Location: ../dashboard.php");
} else {
    $conn->close();
    header("Location: ../error.php");
}