<?php
$email = $_POST['email'];
$pass = $_POST['password'];
$usertype = $_POST['userType'];

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  header("Location: ../error.php");
}

$sql = "SELECT id, first_name, last_name, dept_id FROM users WHERE email='" . $email . "' AND password='" . $pass ."' AND user_type=" . $usertype;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    setcookie("ID", $row["id"], time() + (86400 * 30), "/");
    setcookie("UserName", $row["first_name"] . " " . $row["last_name"], time() + (86400 * 30), "/");
    setcookie("UserType", (string)$usertype, time() + (86400 * 30), "/");
    setcookie("DeptId", (string)$row["dept_id"], time() + (86400 * 30), "/");
    if($usertype == "2"){
      $sql2 = "SELECT subject_id FROM subject_mapper WHERE user_id=" . $row["id"];
      $subjectResult = $conn->query($sql2);
      if($subjectResult->num_rows > 0){
        while($row2 = $subjectResult->fetch_assoc()){
          setcookie("SubId", (string)$row2["subject_id"], time() + (86400 * 30), "/");
        }
      }
    }
    $conn->close();
    header("Location: ../dashboard.php");
    exit;
  }
} else {
  header("Location: ../error.php?login=false");
}
$conn->close();
