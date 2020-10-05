<?php
setcookie("ID", "", time() - 3600, "/");
setcookie("UserName", "", time() - 3600, "/");
header("Location: ../index.php");
exit;
?>