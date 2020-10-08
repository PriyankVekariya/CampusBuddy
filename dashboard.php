<?php
if (!isset($_COOKIE["ID"]) && !isset($_COOKIE["UserName"])) {
    header("Location: index.php");
    exit;
} else {
    if ($_COOKIE["ID"] == "") {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CampusBuddy - Dashboard</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="" class="navbar-brand">CampusBuddy</a>
        <label><?php echo $_COOKIE["UserName"];?></label>
        <form action="php/logout.php" method="POST">
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    </nav>
    <div class="container">
        <div class="row">
            <?php
            if ($_COOKIE["UserType"] == "3") { ?>
                <p>You are admin</p>
            <?php
            } else if ($_COOKIE["UserType"] == "2") { ?>
                <p>You are Faculty</p>
            <?php
            } else if ($_COOKIE["UserType"] == "1") { ?>
                <p>You are student</p>
            <?php
            } else { ?>
                <p>Please login first</p>
            <?php
            } ?>
        </div>
    </div>
</body>

</html>