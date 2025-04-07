<?php      
    // host trong docker la db
    $host = "db:3307"; 
    $user = "root";  
    $password = "root";  
    $db_name = "demo";  
    $conn = mysqli_connect($host, $user, $password, $db_name);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>  