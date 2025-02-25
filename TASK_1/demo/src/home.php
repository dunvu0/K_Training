<?php
session_start();


if (isset($_SESSION["username"])){
    $username = htmlspecialchars($_SESSION["username"], ENT_QUOTES, 'UTF-8');
    echo "<h1>Hello, " . $username . "!</h1>";
} 
else {
    echo "<h1> Hello guest! </h1>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>


</body>
</html>