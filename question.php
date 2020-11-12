<!DOCTYPE html>
<?php
    $dept_id = $_COOKIE["DeptId"];
    $subjectsQuery = "SELECT * FROM subjects WHERE dept_id=" . $dept_id;
    
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
                                    <h2>Ask question</h2>
                                    <div class="ml-auto">
                                        <a href="notifications.php" class="btn btn-outline-primary">Notifications</a>
                                        <a href="dashboard.php" class="btn btn-outline-primary">Back to all questions</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="php/addQuestion.php" method="POST">
                                    <div class="form-group">
                                        <label>Select subject</label>
                                        <select name="subId" class="form-control">
                                            <?php $subjectsResult = executeQuery($subjectsQuery);
                                            while ($row = $subjectsResult->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['subject_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="question-title">Title</label>
                                        <input id="question-title" max="50" name="title" type="text" class="form-control" value="" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="question-text">Explain your query</label>
                                        <textarea id="question-text" class="form-control" rows="10" name="questionText" maxlength="500"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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