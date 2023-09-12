<?php

@include 'config.php';

session_start();
session_unset();
session_destroy();

header('location:../_login_form/login_form.php');

?>