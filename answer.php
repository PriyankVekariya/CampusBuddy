<!DOCTYPE html>
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
$question_desc = $_POST['question_desc'];
$question_id = $_POST['question_id'];
$student_id = $_POST['student_id'];
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ask question</title>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h2>Answer</h2>
                                    <div class="ml-auto">
                                        <a href="Facultypanel.php" class="btn btn-outline-primary">Back to all unanswer questions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="php/addAnswer.php" method="POST">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id;?>">
                                    <input type="hidden" name="question_id" value="<?php echo $question_id;?>">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <input name="question" type="textarea" class="form-control" value="<?php echo $question_desc;?>" disabled="disabled">
                                    </div>
                                    <div class="form-group">
                                        <label>Explain your answer</label>
                                        <textarea class="form-control" rows="10" maxlength="500" name="answerText" placeholder="Write your answer here...."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>