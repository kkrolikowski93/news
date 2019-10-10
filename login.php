<?php
session_start();
include('nav.php');
require_once('user.php');
$user = new User();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isLoggedIn = $user->userLogin($email, $password);

    if ($isLoggedIn) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Wrong credentials';
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style.css">
</head>

<script>

    function submitlogin() {
        var form = document.login;
        if (form.email.value == "") {
            alert("Enter email or username.");
            return false;
        }
        else if (form.password.value == "") {
            alert("Enter password.");
            return false;
        }
    }

</script>
<h1>Login Here</h1>
<form action="" method="post" name="login">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Enter your email"/>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password"/>
    <input onclick="return(submitlogin());" type="submit" class="submit" name="submit" value="Login"/>

    <a class="submit" href="registration.php">Register</a>

</form>
</div>
</html>
