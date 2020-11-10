<?php
$userId = $_COOKIE["ID"];
$question_id = $_POST['question_id'];
$answerText =$_POST['answerText'];
$student_id = $_POST['student_id'];

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    header("Location: ../error.php");
}

$query = "INSERT INTO answers(user_id, question_id, answer) VALUES (" . $userId . ", " . $question_id . ", '" . $answerText . "')";
$answeredQuery = "UPDATE questions SET answered=1 WHERE id=" . $question_id;
$answeredResult = $conn->query($answeredQuery);

$message = "Your answer is submitted successfully.";
$studentmessage = "Your question is answered. Please check dashboard.";
$notificationQuery = "INSERT INTO notifications(user_id, message) VALUES(" . $userId . ", '" . $message . "')";
$studentnotification = "INSERT INTO notifications(user_id, message) VALUES(" . $student_id . ", '" . $studentmessage . "')";
$studentResult = $conn->query($studentnotification);
$deleteNotification = "DELETE FROM notifications WHERE timestamp < now() - interval 5 day";
$deletionResult = $conn->query($deleteNotification);

$result = $conn->query($query);

if($result){
    $notificationResult = $conn->query($notificationQuery);
    $conn->close();
    header("Location: ../notifications.php");
} else {
    $conn->close();
    header("Location: ../error.php");
}