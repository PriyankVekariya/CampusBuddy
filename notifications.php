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
$user_id = $_COOKIE['ID'];
$notificationsQuery = "SELECT * FROM notifications WHERE user_id=" . $user_id;
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
    <title>CampusBuddy - Dashboard</title>
    <link rel="stylesheet" href="css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="css/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">CampusBuddy</a>
        <form class="form-inline" action="php/logout.php" method="POST">
            <a href="dashboard.php" class="btn btn-outline-primary">Back to all questions</a>
            <label style="margin-right: 5px; font-weight: bold;"><?php echo ($_COOKIE["UserName"]); ?></label>
            <button class="btn btn-primary" type="submit">Logout</button>
        </form>
    </nav>
    <section>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <?php $notificationsResult = executeQuery($notificationsQuery);
                        if ($notificationsResult->num_rows > 0) {
                            while ($row = $notificationsResult->fetch_assoc()) { 
                                $new_datetime = DateTime::createFromFormat ( "Y-m-d H:i:s", $row["timestamp"] ); ?>
                                <div class="card">
                                    <div class="card-body">
                                        <label><?php echo $row['message']; ?></label><br/>
                                        <label><?php echo $new_datetime->format('d/m/y, h:i:s A') ?></label>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="card">
                                <div class="card-body">
                                    <label>You don't have any notifications</label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>
    </section>
</body>

</html>