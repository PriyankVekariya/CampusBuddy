<?php
$email = $_POST['email'];
$pass = $_POST['password'];
$usertype = $_POST['userType'];
echo $email . $pass . $usertype;

$conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, first_name, last_name FROM users WHERE email='" . $email . "' AND password='" . $pass ."' AND user_type=" . $usertype;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    setcookie("ID", $row["id"], time() + (86400 * 30), "/");
    setcookie("UserName", $row["first_name"] . " " . $row["last_name"], time() + (86400 * 30), "/");
    setcookie("UserType", (string)$usertype, time() + (86400 * 30), "/");
    $conn->close();
    header("Location: ../dashboard.php");
    exit;
  }
} else {
  echo "0 results";
}
$conn->close();
?>
