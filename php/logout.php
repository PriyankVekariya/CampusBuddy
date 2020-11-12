<?php
setcookie("ID", "", time() - 3600, "/");
setcookie("UserName", "", time() - 3600, "/");
setcookie("UserType", "", time() - 3600, "/");
setcookie("DeptId", "", time() - 3600, "/");
setcookie("SubId", "", time() - 3600, "/");
header("Location: ../index.php");
exit;
?>