<?php
session_start();
include "./class.php";


if (isset($_COOKIE["user_data"])) {
    try {
        $user = unserialize(base64_decode($_COOKIE["user_data"]));
    } catch (Exception $e){
        die("Something wrong...");
    }
    if($user->isAdmin){
        echo "<h1> Welcome to the admin panel! </h1>";
        //TODO
        //include(dashboard.php)
    } else{
        // If not an admin, display a forbidden message and exit
        http_response_code(403);
        echo "<h1>Forbidden</h1>";
        echo "<p>You do not have permission to access this page.</p>";
        exit();
    }
    
}
else{
    echo "<br> Login first </br>";
    echo "<p><a href='index.php?page=login'>Go to Login Page</a></p>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

</body>
</html>
