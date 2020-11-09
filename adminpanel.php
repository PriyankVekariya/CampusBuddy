<!DOCTYPE html>
<?php
if ($_COOKIE["UserType"] != "3") {
    header("Location: error.php");
    exit;
}
$tempQuestions = "SELECT * FROM temp_questions";
$departmentsQuery = "SELECT * FROM departments";
$subjectsQuery = "SELECT departments.dept_id, departments.dept_name, subjects.subject_name
        FROM departments
        LEFT JOIN subjects ON departments.dept_id = subjects.dept_id
        ORDER BY departments.dept_name";

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

function approveQuestion($approveId, $userId)
{
    $approveQuery = "SELECT * FROM temp_questions WHERE question_id=" . $approveId;
    $questionData = executeQuery($approveQuery);
    if ($questionData->num_rows > 0) {
        while ($row = $questionData->fetch_assoc()) {
            $addQuestionQuery = "INSERT INTO questions(user_id, title, subject_id, question_description, answered)
                VALUES(" . $userId . ", '" . $row["title"] . "', " . $row["subject_id"] . ", '" . $row["question_description"] . "', 0)";
            $addedQuestionResult = executeQuery($addQuestionQuery);
            $deleteFromTemp = "DELETE FROM temp_questions WHERE question_id=" . $approveId;
            $deleteTempResult = executeQuery($deleteFromTemp);
            header("Location: adminpanel.php");
        }
    } else {
        header("Location: error.php");
    }
}
if (isset($_GET['approveQuestion'])) {
    approveQuestion($_GET['question_id'], $_GET['user_id']);
}

function rejectQuestion($rejectId)
{
    $rejectQuery = "DELETE FROM temp_questions WHERE question_id=" . $rejectId;
    $rejectResult = executeQuery($rejectQuery);
    if ($rejectResult) {
        header("Location: adminpanel.php");
    } else {
        header("Location: error.php");
    }
}
if (isset($_GET['rejectQuestion'])) {
    rejectQuestion($_GET['question_id']);
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin-panel</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <section>
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">CampusBuddy</a>
            <form class="form-inline" action="php/logout.php" method="POST">
                <label style="margin-right: 5px; font-weight: bold;"><?php echo ($_COOKIE["UserName"]); ?></label>
                <button class="btn btn-primary" type="submit">Logout</button>
            </form>
        </nav>
    </section>
    <section>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card spacing">
                            <div class="card-header">
                                <h4>Questions</h4>
                            </div>
                            <?php $tempQueResult = executeQuery($tempQuestions);
                            if ($tempQueResult->num_rows > 0) {
                                while ($row = $tempQueResult->fetch_assoc()) { ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <p><?php echo $row['timestamp']; ?></p>
                                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                            <p class="card-text"><?php echo $row['question_description']; ?></p>
                                            <a href="adminpanel.php?approveQuestion=true&question_id=<?php echo $row['question_id']; ?>&user_id=<?php echo $row['user_id']; ?>" class="btn btn-success">Approve</a>
                                            <a href="adminpanel.php?rejectQuestion=true&question_id=<?php echo $row['question_id']; ?>" class="btn btn-danger">Reject</a>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>No questions found to validate.</h4>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card spacing">
                            <div class="card-header">
                                <h4>Departments</h4>
                            </div>
                            <?php $deptResult = executeQuery($departmentsQuery);
                            while ($row = $deptResult->fetch_assoc()) { ?>
                                <div class="card card-body">
                                    <p><?php echo $row['dept_name']; ?></p>
                                </div>
                            <?php } ?>
                            <table border="0">
                                <tr>
                                    <form action="php/addDepartment.php" method="POST">
                                        <td><input type="text" class="form-control" name="deptName" placeholder="Enter department name" required="required" /></td>
                                        <td><input type="submit" class="btn btn-primary" value="Add department" /></td>
                                    </form>
                                </tr>
                            </table>
                        </div>
                        <div class="card spacing">
                            <div class="card-header">
                                <h4>Subjects<h4>
                            </div>
                            <table border="0" class="card card-body">
                                <tr>
                                    <th>Departnemt Name</th>
                                    <th>Subject Name</th>
                                </tr>
                                <?php $subjectResult = executeQuery($subjectsQuery);
                                while ($row = $subjectResult->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['dept_name']; ?></td>
                                        <td><?php echo $row['subject_name']; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <form action="php/addSubject.php" method="POST">
                                        <td>
                                            <select name="deptId">
                                                <?php $deptResult = executeQuery($departmentsQuery);
                                                while ($row = $deptResult->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" name="subName" placeholder="Enter subject name" required="required" /></td>
                                        <td><input type="submit" class="btn btn-primary" value="Add subject" /></td>
                                    </form>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>