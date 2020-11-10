<?php 
$login_failed = "";
if (isset($_GET['login'])) {
    $login_failed = "Please check your credentials.";
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
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">CampusBuddy</a>
        <form class="form-inline" action="php/logout.php" method="POST">
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    </nav>
    <section>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card card-body">
                                <h4><?php echo ($login_failed === "") ? "Something went wrong." : $login_failed ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>
</html>