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

$dept_id = $_COOKIE['DeptId'];
$dashboardQuery = "SELECT * FROM (SELECT questions.title, questions.question_description, answers.answer, questions.subject_id, questions.answered,
    questions.timestamp AS quetimestamp, answers.timestamp AS anstimestamp, questions.user_id AS student_id, answers.user_id AS faculty_id
    FROM questions
    LEFT JOIN answers ON questions.id = answers.question_id
    ORDER BY questions.timestamp DESC) AS joined_result WHERE answered=true AND subject_id IN (SELECT subject_id FROM subjects WHERE dept_id=" . $dept_id .")";
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
                                    <h4>All questions</h4>
                                    <?php if ($_COOKIE["UserType"] == "1") { ?>
                                        <div class="ml-auto">
                                            <a href="question.php" class="btn btn-primary">Ask new question</a>
                                        </div>
                                    <?php } else if ($_COOKIE["UserType"] == "2") { ?>
                                        <div class="ml-auto">
                                            <a href="facultypanel.php" class="btn btn-primary">Answer questions</a>
                                        </div>
                                    <?php } else if ($_COOKIE["UserType"] == "3") { ?>
                                        <div class="ml-auto">
                                            <a href="adminpanel.php" class="btn btn-primary">Go to admin panel</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php $dashboardResult = executeQuery($dashboardQuery);
                            if ($dashboardResult->num_rows > 0) {
                                while ($row = $dashboardResult->fetch_assoc()) {
                                    $facultyQuery = "SELECT first_name, last_name FROM users WHERE id=" . $row['faculty_id'];
                                    $facultyResult = executeQuery($facultyQuery);
                                    $faculty_name = "";
                                    while ($faculty_row = $facultyResult->fetch_assoc()) {
                                        $faculty_name = $faculty_row['first_name'] . " " . $faculty_row['last_name'];
                                        break;
                                    }
                                    $studentQuery = "SELECT first_name, last_name FROM users WHERE id=" . $row['student_id'];
                                    $studentResult = executeQuery($studentQuery);
                                    $student_name = "";
                                    while ($student_row = $studentResult->fetch_assoc()) {
                                        $student_name = $student_row['first_name'] . " " . $student_row['last_name'];
                                        break;
                                    }
                                    $que_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $row["quetimestamp"]);
                                    $ans_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $row["anstimestamp"]); ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="username"><?php echo $student_name; ?></label>
                                            <label><?php echo $que_datetime->format('d/m/y, h:i:s A'); ?></label><br />
                                            <label><?php echo "Title: " . $row['title']; ?></label><br />
                                            <label><?php echo "Question: " . $row['question_description']; ?></label><br />
                                            <label class="username"><?php echo $faculty_name; ?></label>
                                            <label><?php echo $ans_datetime->format('d/m/y, h:i:s A'); ?></label><br />
                                            <label><?php echo "Answer: " . $row['answer']; ?></label>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <label>No questions found.</label>
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