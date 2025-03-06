<?php      
    // trong docker la dbb
    // $host = "172.30.13.232:3306"; 
    $host = "db"; 
    $user = "root";  
    $password = "root";  
    $db_name = "demo";  
    $conn = mysqli_connect($host, $user, $password, $db_name);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>  