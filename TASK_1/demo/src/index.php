<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <h1>demo </h1>
    <nav>
        <ul>
            <li><a href="index.php?page=login.php">Login Page</a></li>
            <li><a href="index.php?page=register.php">Register Page</a></li>
            <li><a href="home.php">Home Page</a></li>
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>



</body>
</html>


<?php

//phpinfo();
// xdebug_info();
if(isset($_GET["page"])){
    include($_GET["page"]);
}
?>