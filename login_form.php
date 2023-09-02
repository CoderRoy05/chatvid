<?php

@include 'config.php';

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
            header('location:admin_page.php');

        } elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
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
    <title>login form</title>
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92d5066f88e4b01fb04c_Favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://assets.website-files.com/649c8fc778e7e4d075c5a3f1/649c92f6de92f26a686c00ae_Webclip.png" rel="apple-touch-icon" />
</head>
<body>
    
    <div class="form-container">

        <form action="" method="post">
            <h3>login now</h3>
        <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
        ?>
            <input type="email" name="email" placeholder="enter your email" required>
            <label for="showPassword">
                <input type="checkbox" id="showPassword"> 
                <i id="showPasswordIcon" class="fa-solid fa-eye-slash" aria-hidden="true" > Hide</i>
            </label>
            <input type="password" name="password" id="password" placeholder="enter your password" required>
            
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="register_form.php">register now</a> </p>
        </form>
    </div>
    

<script>
   const passwordInput = document.getElementById('password');
   const showPasswordCheckbox = document.getElementById('showPassword');
   const showPasswordIcon = document.getElementById('showPasswordIcon');

   showPasswordCheckbox.addEventListener('change', function () {
      if (this.checked) {
         passwordInput.type = 'text';
         showPasswordIcon.className = 'fa fa-eye';
         showPasswordCheckbox.nextElementSibling.textContent = ' Show';
      } else {
         passwordInput.type = 'password';
         showPasswordIcon.className = 'fa fa-eye-slash';
         showPasswordCheckbox.nextElementSibling.textContent = ' Hide';
      }
   });
</script>


</body>
</html>
