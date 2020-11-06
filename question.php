<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ask question</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <section>
    <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">CampusBuddy</a>
    <p><span style="color:darkolivegreen;font-weight:bold"><?php echo($_SESSION["name"]); ?></span></p>
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
                                <a href="adminpanel.php" class="btn btn-outline-primary">Back to all questions</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            <div>
                                 <label for="cars">Select department</label>
                                  <select name="department" id="department"><br>
                                    <option value="cs">Computer Engineering</option>
                                     <option value="it">Information Technology</option>
                                     <option value="ee">Electrical</option>
                                     <option value="au">Automobile</option>
                                     <option value="ch">Chemical</option>
                                     <option value="ce">Civil</option>
                                     <option value="me">Mechanical</option>
                                     <option value="ict">Information & Communication Technology</option>
                                  </select>
                             </div>
                            <input type="hidden" name="_token" value="bNOwFIwINecFiufSqmhuJxBnsqR9vd3IQTiNJoco">                
                            <div class="form-group">
                                <label for="question-title">Title</label>
                                <input id="question-title" name="title" type="text" class="form-control " value="" required="required">  
                            </div>
                            <div class="form-group">
                                <label>Explain your question</label>
                                <textarea class="form-control" rows="10" id="comment" name="text"></textarea>
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