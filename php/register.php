<?php
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$pass = $_POST["password"];
$userType = $_POST["userType"];
$dept_id = 0;
$sub_id = 0;

if($userType==2){
    $idArr = explode("-", $_POST["deptSubId"]);
    $dept_id = $idArr[0];
    $sub_id = $idArr[1];
} else {
    $dept_id = $_POST["deptId"];
}

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (email, first_name, last_name, password, user_type, dept_id)
VALUES ('" . $email . "', '" . $firstName . "', '" . $lastName . "', '" . $pass . "', " . $userType . ", " . $dept_id . ")";

if ($conn->query($sql) === TRUE) {
    $sql2 = "SELECT id from users WHERE email='" . $email . "'";
    $result = $conn->query($sql2);
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        setcookie("ID", $id, time() + (86400 * 30), "/");
        if($userType==2){
            $facultySubQuery = "INSERT INTO subject_mapper(user_id, subject_id) VALUES(" . $id . ", " . $sub_id . ")";
            $facultyResult = $conn->query($facultySubQuery);
            if(!$facultyResult) {
                header("Location: ../error.php");
            } else {
                setcookie("SubId", (string)$sub_id, time() + (86400 * 30), "/");
            }
        }
    }
    setcookie("DeptId", (string)$dept_id, time() + (86400 * 30), "/");
    setcookie("UserName", $firstName . " " . $lastName, time() + (86400 * 30), "/");
    setcookie("UserType", (string)$userType, time() + (86400 * 30), "/");
    $conn->close();
    header("Location: ../dashboard.php");
    exit;
} else {
    header("Location: ../error.php");
}

$conn->close();
