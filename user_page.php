<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>
    <link rel="stylesheet" href="css/account.css">
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92d5066f88e4b01fb04c_Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92f6de92f26a686c00ae_Webclip.png" rel="apple-touch-icon" />
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>Hi, <span>user</span></h3>
            <h1>Welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
            <p>this is an user page</p>
            <a href="login_form.php" class="btn">login</a>
            <a href="register_form.php" class="btn">register</a>
            <a href="logout.php" class="btn">logout</a>
        </div>
    </div>
</body>
</html>