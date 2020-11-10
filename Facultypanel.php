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
if ($_COOKIE["UserType"] != "2") {
    header("Location: error.php");
    exit;
}

function executeQuery($query)
{
    $conn = new mysqli("localhost", "rootuser", "toor", "campus_buddy");
    if ($conn->connect_error) {
        header("Location: error.php");
    }
    $result = $conn->query($query);
    $conn->close();
    return $result;
}
$sub_id = (int)$_COOKIE['SubId'];
$facultyQuery = "SELECT * FROM questions WHERE (subject_id=" . $sub_id . " AND answered=false)";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Faculty - Dashboard</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">CampusBuddy</a>
        <form class="form-inline" action="php/logout.php" method="POST">
        <a href="notifications.php" class="btn btn-outline-primary">Notifications</a>
            <label style="margin: 5px; font-weight: bold;"><?php echo ($_COOKIE["UserName"]); ?></label>
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
                                    <h2>All unanswered question</h2>
                                    <div class="ml-auto">
                                        <a href="dashboard.php" class="btn btn-outline-primary">Back to dashboard</a>
                                    </div>
                                </div>
                            </div>
                            <?php $facultyResult = executeQuery($facultyQuery);
                            if ($facultyResult->num_rows > 0) {
                                while ($row = $facultyResult->fetch_assoc()) {
                                    $que_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $row["timestamp"]); ?>
                                    <div class="card card-body">
                                        <div class="media post">
                                            <form action="answer.php" method="POST">
                                                <input type="text" class="form-control" disabled="disabled" name="quetitle" value="<?php echo $row['title']; ?>"/>
                                                <p><?php echo $que_datetime->format('d/m/y, h:i:s A'); ?></p>
                                                <input type="textarea" class="form-control" disabled="disabled" name="question_desc" value="<?php echo $row['question_description']; ?>"/>
                                                <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>" /><br/>
                                                <input type="hidden" name="student_id" value="<?php echo $row['user_id']; ?>" /><br/>
                                                <input type="submit" class="btn btn-primary" value="Give answer" />
                                            </form>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="card-body">
                                    <div class="media post">
                                        <div class="d-flex align-items-center">
                                            <p>No questions to answer</p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>