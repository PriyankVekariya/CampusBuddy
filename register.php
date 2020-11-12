<?php
if (isset($_COOKIE["ID"]) && isset($_COOKIE["UserName"])) {
    if ($_COOKIE["ID"] != "") {
        header("Location: dashboard.php");
        exit;
    }
}

$departmentsQuery = "SELECT * FROM departments";
$subjectsQuery = "SELECT departments.dept_id, departments.dept_name, subjects.subject_name, subjects.subject_id
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign up page</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function checkPassword(form) {
            password = form.password.value;
            confirmPassword = form.confirmPassword.value;
            if (password != confirmPassword) {
                alert("Password did not match: Please try again...");
                return false;
            } else {
                return true;
            }
        }
        $(document).ready(function() {
            $('#facultyDeptSubSelection').hide();
            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'facultyRadio') {
                    $('#facultyDeptSubSelection').show();
                    $('#studentDeptSelection').hide();
                } else {
                    $('#facultyDeptSubSelection').hide();
                    $('#studentDeptSelection').show();
                }
            });
        });
    </script>
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
                        <?php if (!(isset($_COOKIE["UserMail"]) && !($_COOKIE["UserMail"] == ""))) { ?>
                            <form id="signUpFrom" action="php/register.php" method="POST" onSubmit="return checkPassword(this)">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="userType">Register as</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" value="1" id="studentRadio" name="userType" required="required" checked="checked">
                                            <label class="custom-control-label" for="studentRadio">Student</label>
                                        </div>

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" value="2" id="facultyRadio" name="userType" required="required">
                                            <label class="custom-control-label" for="facultyRadio">Faculty</label>
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
                                        <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required="required">
                                    </div>
                                    <div class="form-group" id="studentDeptSelection">
                                        <select name="deptId" class="form-control">
                                            <?php $deptResult = executeQuery($departmentsQuery);
                                            while ($row = $deptResult->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="facultyDeptSubSelection">
                                        <select name="deptSubId" class="form-control">
                                            <?php $subResult = executeQuery($subjectsQuery);
                                            while ($row = $subResult->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['dept_id'] . "-" . $row['subject_id']; ?>"><?php echo $row['dept_name'] . " - " . $row['subject_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Create account</button>
                                    <div>
                                        <span class="psw"><a href="index.php">Registered user? Log in</a></span>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="form-group">
                                <form id="SendOTPform" method="POST" action="php/validateEmail.php">
                                    <div class="form-group">
                                        <input type="email" class="form-control email" name="temp_email" placeholder="Email address" required="required">
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Send OTP</button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>