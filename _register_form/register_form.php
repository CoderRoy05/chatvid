<?php

@include '../config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $error[] = 'user already exist!';
    }else{
        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";

            mysqli_query($conn, $insert);
            header('location:../_login_form/login_form.php');
        }
    }
};



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-form | ChatVid</title>
    <link rel="stylesheet" href="register_form.css">
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92d5066f88e4b01fb04c_Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92f6de92f26a686c00ae_Webclip.png" rel="apple-touch-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<style>
    .login-box{
        height: 820px;
    }
</style>


    <form action="" method="post" id="myForm" onsubmit="return validateForm()">
    <div class="login-box">
        <div class="login-header">
            <header>REGISTER NOW</header>
            <p>We are happy to have you onboard!</p>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
        </div>
        
        <div class="input-box">
            <input type="text" name="name" class="input-field" required>
            <label for="password">Name</label>
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
            <input type="password" name="cpassword" class="input-field" id="cpassword" autocomplete="off" required>
            <label for="cpassword">Confirm Password</label>
            <div class="eye-area">
                <div class="eye-box">
                    <i class="fa-regular fa-eye-slash" id="cEye"></i>
                    <i class="fa-regular fa-eye" id="cEye-slash"></i>
                </div>
            </div>
        </div>
        <p class="selection">Select Account Type: *</p>
            <select name="user_type" id="userType" required>
                <option value="" disabled selected></option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        <div class="input-box">
            <input type="submit" name="submit" class="input-submit" value="Register Now">
        </div>
        <div class="middle-text">
            <hr>
            <p class="or-text">Or</p>
        </div>
        <div class="social-sign-in">
            <section class="bottom">
                <p>Already have an account? <a href="../_login_form/login_form.php">Login now</a></p>
            </section>
        </div>
    </div>
    </form>


    <script>
        function validateForm() {
            var userType = document.getElementById("userType").value;
  
            if (userType === "") {
                alert("Please select a user type.");
                return false; // Prevent form submission
            }
  
            // If a valid option is selected, the form will submit
            return true;
        }
    </script>



    <script>
        const passwordInput = document.getElementById("password");
        const cpasswordInput = document.getElementById("cpassword");
        const eyeIcon = document.getElementById("eye");
        const eyeSlashIcon = document.getElementById("eyeicon");
        const cEyeIcon = document.getElementById("cEye");
        const cEyeSlashIcon = document.getElementById("cEye-slash");

        eyeIcon.addEventListener("click", togglePasswordVisibility);
        eyeSlashIcon.addEventListener("click", togglePasswordVisibility);
        cEyeIcon.addEventListener("click", toggleCPasswordVisibility);
        cEyeSlashIcon.addEventListener("click", toggleCPasswordVisibility);

        function togglePasswordVisibility() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            eyeIcon.style.display = type === "password" ? "block" : "none";
            eyeSlashIcon.style.display = type === "password" ? "none" : "block";
        }

        function toggleCPasswordVisibility() {
            const type = cpasswordInput.getAttribute("type") === "password" ? "text" : "password";
            cpasswordInput.setAttribute("type", type);
            cEyeIcon.style.display = type === "password" ? "block" : "none";
            cEyeSlashIcon.style.display = type === "password" ? "none" : "block";
        }
    </script>


</body>
</html>