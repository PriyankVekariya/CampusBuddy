<!DOCTYPE html>
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
                                <form action="#" method="POST">
                                    <input type="hidden" name="_token" value="bNOwFIwINecFiufSqmhuJxBnsqR9vd3IQTiNJoco">
                                    <div class="form-group">
                                        <label for="question-title">Title</label>
                                        <input id="question-title" name="title" type="text" class="form-control " value="" required="required">
                                    </div>
                                    <input type="hidden" name="_token" value="bNOwFIwINecFiufSqmhuJxBnsqR9vd3IQTiNJoco">
                                    <div class="form-group">
                                        <label for="question-title">Question</label>
                                        <input id="question-title" name="title" type="text" class="form-control " value="" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label>Explain your answer</label>
                                        <textarea class="form-control" rows="10" id="comment" name="text" placeholder="Explain your answer here...."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info" href="dashboard.php">Submit</button>
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