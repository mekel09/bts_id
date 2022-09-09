<?php
session_start();
include_once 'dao/activitydaoimpl.php';
include_once 'dao/userdaoimpl.php';
include_once 'dao/facultydaoimpl.php';
include_once 'entity/user.php';
include_once 'entity/activity.php';
include_once 'entity/faculty.php';
include_once 'db_util/PDOUtil.php';
include_once 'db_util/db_util.php';
include_once 'faculty_function/faculty_function.php';
include_once 'activity_function/activity_function.php';
include_once 'user/User_Function.php';
if (!isset($_SESSION['my_session'])) {
    $_SESSION['my_session'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Michael Sebastian(1872005)">
    <title>BTS.ID</title><!-- CSS only -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="comment_script.js"></script>
    <link rel="stylesheet" type = "text/css" href="styles/styles.css">
</head>

<body>
    <div class="container">
        <?php
        if ($_SESSION['my_session']) {
        ?>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Maranatha Christian University</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="?menu=cat">Faculty</a></li>
                        <li><a href="?menu=book">Activity</a></li>
                        <li><a href="?menu=logout">Logout</a></li>
                    </ul>
                </div>
            </nav>
            <div>
                <?php
                $menu = filter_input(INPUT_GET, 'menu');
                switch ($menu) {
                    case 'cat':
                        include_once 'faculty-page.php';
                        break;
                    case 'book':
                        include_once 'activity-page.php';
                        break;
                    case 'catu':
                        include_once 'faculty_update_page.php';
                        break;
                    case 'buku':
                        include_once 'activity_update_page.php';
                        break;
                    case 'register':
                        include_once 'register.php';
                        break;
                    case 'logout';
                        session_unset();
                        session_destroy();
                        header("location:index.php");
                        break;
                    default:
                        include_once 'home.php';
                }
                ?>
            </div>
        <?php
        } else {
            include_once 'login_page.php';
        }
        ?>
    </div>
</body>

</html>