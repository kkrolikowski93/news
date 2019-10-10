<?php
session_start();
include('nav.php');
include_once 'user.php';
$user = new User();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['gender'])
&& isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['password_2'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password_2'];
    $gender = $_POST['gender'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $register = $user->userRegister($firstName, $lastName, $email, $gender, $password);

    if ($password !== $password2) {
        echo 'Passwords don\'t match';
    } else {
        if ($register) {
            echo 'Registration successful <a href="login.php">Click here</a> to login';
            exit();
        } else {
            // Registration Failed
            echo 'Registration failed. Email exists';
        }
    }
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<div id="container">
    <h1>Registration Here</h1>
    <form action="" method="post" name="reg">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" required placeholder="Enter your first name"/>

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" required placeholder="Enter your last name"/>

        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter your email"/>

        <label for="gender">Gender</label><br />
        <label><input type="radio" name="gender" value="boy" required= />Boy</label><br />
        <label><input type="radio" name="gender" value="girl" required />Girl</label><br />
        <br/>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password"/>

        <label for="password+2">Repeat password</label>
        <input type="password" id="password_2" name="password_2" required placeholder="Enter your password"/>
        <input type="submit" class="submit" name="submit" value="Register"/>
    </form></div>

