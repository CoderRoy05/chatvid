<?php

@include 'config.php';

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
            header('location:login_form.php');
        }
    }
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92d5066f88e4b01fb04c_Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92f6de92f26a686c00ae_Webclip.png" rel="apple-touch-icon" />
</head>
<body>
    
    <div class="form-container">

        <form action="" method="post">
            <h3>register now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="text" name="name" placeholder="enter your name" required>
            <input type="email" name="email" placeholder="enter your email" required>
            <label for="showPassword">
                <input type="checkbox" id="showPassword"> 
                <i id="showPasswordIcon" class="fa-solid fa-eye-slash" aria-hidden="true" > Hide</i>
            </label>
            <input type="password" name="password" id="password" placeholder="enter your password" required>
            <input type="password" name="cpassword" id="cpassword" placeholder="confirm your password" required>
            <p class="selection">Select Account type</p>
            <select name="user_type">
                <!-- <option value="">Select</option> -->
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login_form.php">login now</a> </p>
        </form>
    </div>


<script>
    const passwordInput = document.getElementById('password');
    const cpasswordInput = document.getElementById('cpassword');
    const showPasswordCheckbox = document.getElementById('showPassword');
    const showPasswordIcon = document.getElementById('showPasswordIcon');

    showPasswordCheckbox.addEventListener('change', function () {
        const isChecked = this.checked;
        passwordInput.type = isChecked ? 'text' : 'password';
        cpasswordInput.type = isChecked ? 'text' : 'password';
        showPasswordIcon.className = isChecked ? 'fa fa-eye' : 'fa fa-eye-slash';
        showPasswordIcon.textContent = isChecked ? ' Show' : ' Hide';
    });
</script>


</body>
</html>