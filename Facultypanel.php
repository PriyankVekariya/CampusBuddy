<?php
session_start();
if(!isset($_COOKIE["ID"]) && !isset($_COOKIE["UserName"])) {
    header("Location: index.php");
    exit;
} else {
    if($_COOKIE["ID"] == ""){
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
    <title>Faculty - Dashboard</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">CampusBuddy</a>
    <form class="form-inline" action="php/logout.php" method="POST">
        <p><span><?php echo($_SESSION["name"]); ?></span></p>
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
                            <h2>All Unanswered question</h2>
                            <div class="ml-auto">
                                <a href="Facultypanel.php" class="btn btn-outline-primary">Answer questions</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="media post">
                             <div class="d-flex align-items-center">
                             <p>question</p> 
                                                      
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