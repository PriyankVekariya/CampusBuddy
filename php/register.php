<?php
session_start();
$pass = $_POST["password"];
$confirmPass = $_POST["confirmPassword"];
if ($pass != $confirmPass) {
    header("Location: /CampusBuddy/register.php");
    exit;
}
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$userType = $_POST["userType"];

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (email, first_name, last_name, password, user_type)
VALUES ('" . $email . "', '" . $firstName . "', '" . $lastName . "', '" . $pass . "', " . $userType . ")";

if ($conn->query($sql) === TRUE) {
    $sql2 = "SELECT id from users WHERE email='" . $email . "'";
    $result = $conn->query($sql2);
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        setcookie("ID", $id, time() + (86400 * 30), "/");
    }
    setcookie("UserName", $firstName . " " . $lastName, time() + (86400 * 30), "/");
     $_SESSION["name"]=$email;

    setcookie("UserType", (string)$userType, time() + (86400 * 30), "/");
    header("Location: ../dashboard.php");
    $conn->close();
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
