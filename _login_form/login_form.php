<?php

@include '../config.php';

session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:../_admin_page/admin_page.php');

        } elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:../_user_page/user_page.php');
        }
    } else {
        $error[] = 'incorrect email or password!';
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-form | ChatVid</title>
    <link rel="stylesheet" href="login_form.css">
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92d5066f88e4b01fb04c_Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92f6de92f26a686c00ae_Webclip.png" rel="apple-touch-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
        .login-box{
            height: 570px;
        }
    </style>

        <form action="" method="post">
            <div class="login-box">
                <div class="login-header">
                    <header>LOGIN NOW</header>
                    <p>We are happy to have you back!</p>
                <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                ?>
                </div>
                <div class="input-box">
                    <input type="email" name="email" class="input-field" autocomplete="off" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" class="input-field" id="password" autocomplete="off" required>
                    <label for="password">Password</label>
                    <div class="eye-area">
                        <div class="eye-box">
                            <i class="fa-regular fa-eye-slash" id="eye"></i>
                            <i class="fa-regular fa-eye" id="eyeicon"></i>
                        </div>
                    </div>
                </div>
                <div class="input-box">
                    <input type="submit" name="submit" class="input-submit" value="login Now">
                </div>
                <div class="middle-text">
                    <hr>
                    <p class="or-text">Or</p>
                </div>
                <div class="social-sign-in">
                    <section class="bottom">
                        <p>Not a member yet? <a href="../_register_form/register_form.php">Register Now</a></p>
                    </section>
                </div>
            </div>
        </form>





    <script>
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye");
        const eyeSlashIcon = document.getElementById("eyeicon");

        eyeIcon.addEventListener("click", togglePasswordVisibility);
        eyeSlashIcon.addEventListener("click", togglePasswordVisibility);

        function togglePasswordVisibility() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            eyeIcon.style.display = type === "password" ? "block" : "none";
            eyeSlashIcon.style.display = type === "password" ? "none" : "block";
        }
    </script>


   </body>
</html>