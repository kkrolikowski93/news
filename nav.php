<ul>
    <li><a href="index.php">Home</a></li>
    <?php if (isset($_SESSION['user_id'])) :?>
        <li><a href="newsPanel.php">News panel</a></li>
        <li style="float:right"><a class="active" href="index.php?state=logout">Logout</a></li>
    <?php else:?>
        <li style="float:right"><a class="active" href="login.php">Login</a></li>
    <?php endif;?>
</ul>