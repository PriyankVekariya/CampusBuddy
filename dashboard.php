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
$dashboardQuery = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CampusBuddy - Dashboard</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">CampusBuddy</a>
        <form class="form-inline" action="php/logout.php" method="POST">
            <a href="notifications.php" class="btn btn-outline-primary">Notifications</a>
            <label style="margin-right: 5px; font-weight: bold;"><?php echo ($_COOKIE["UserName"]); ?></label>
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    </nav>
    <section>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4>All questions</h4>
                                    <?php if ($_COOKIE["UserType"] == "1") { ?>
                                        <div class="ml-auto">
                                            <a href="question.php" class="btn btn-primary">Ask new question</a>
                                        </div>
                                    <?php } else if ($_COOKIE["UserType"] == "2") { ?>
                                        <div class="ml-auto">
                                            <a href="answer.php" class="btn btn-primary">Answer questions</a>
                                        </div>
                                    <?php } else if ($_COOKIE["UserType"] == "3") { ?>
                                        <div class="ml-auto">
                                            <a href="adminpanel.php" class="btn btn-primary">Go to admin panel</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card card-body">
                                <div class="media post">
                                    <div class="d-flex flex-column counters">
                                        <p>Question</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </section>
</body>

</html>