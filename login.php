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
        echo '<p style="color:red">Wrong credentials</p>';
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="style.css">
</head>

<script>


</script>
<h1>Login Here</h1>
<form action="" method="post" name="login">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" required placeholder="Enter your email"/>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Enter your password"/>
    <input type="submit" class="submit" name="submit" value="Login"/>
    <br /><br />
    <a class="submit" href="registration.php">Register</a>

</form>
</div>
</html>
