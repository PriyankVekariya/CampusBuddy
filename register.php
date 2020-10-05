<?php
if(isset($_COOKIE["ID"]) && isset($_COOKIE["UserName"])) {
    if($_COOKIE["ID"] != ""){
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign up page</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="index.html" class="navbar-brand">CampusBuddy</a>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h6 class="card-title text-center">Register details</h6>
                        <form id="signUpFrom" action="php/register.php" method="POST">
                            <div class="form-group">
                                <label for="userType">Register as</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" value="1" id="defaultInline1" name="userType" required>
                                    <label class="custom-control-label" for="defaultInline1">Student</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" value="2" id="defaultInline2" name="userType" required>
                                    <label class="custom-control-label" for="defaultInline2">Faculty</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="firstName" placeholder="First name" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lastName" placeholder="Last name" required="required">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control email" name="email" placeholder="Email address" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="pass" name="password" placeholder="Password" required="required">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirmpass" name="confirmPassword" placeholder="Confirm Password" required="required">
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Create account</button>
                            <div>
                                <span class="psw"><a href="index.php">Registered user? Log in</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>