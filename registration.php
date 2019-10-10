<?php
session_start();
include_once 'user.php';
$user = new User();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['gender'])
&& isset($_POST['first_name']) && isset($_POST['last_name'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];


    $register = $user->userRegister($firstName, $lastName, $email, $gender, $password);
    if ($register) {
        // Registration Success
        echo 'Registration successful <a href="login.php">Click here</a> to login';
    } else {
        // Registration Failed
        echo 'Registration failed. Email or Username already exits please try again';
    }
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<script type="text/javascript" language="javascript">
    function submitreg() {
        var form = document.reg;
        if(form.name.value == ""){
            alert( "Enter name." );
            return false;
        }
        else if(form.uname.value == ""){
            alert( "Enter username." );
            return false;
        }
        else if(form.upass.value == ""){
            alert( "Enter password." );
            return false;
        }
        else if(form.uemail.value == ""){
            alert( "Enter email." );
            return false;
        }
    }
</script>
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

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password"/>
        <input onclick="return(submitlogin());" type="submit" class="submit" name="submit" value="Register"/>
    </form></div>

