<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
<h2> Blind sqli labs </h2>
<p> Search for userId </p>
<form method="GET" action="">
    <input type="hidden" name="type" value="boolean">
    <label for="id">ID:</label>
    <input type="text" id="id" name="id">
    <input type="submit" value="Search">
</form>
<?php
include("./conn.php");
error_reporting(0);

if(isset($_GET['type']) && $_GET['type'] === 'boolean'){
    if(isset($_GET['id']) ){

        $id=$_GET['id'];
    
    
        $query = "SELECT * FROM users WHERE id='$id' LIMIT 0,1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
    
        if($row){
            echo "Found \n";
          }
        else {
            echo "No such user: " .$id;
        
        }
    }
        else{ 
            echo "Please input the ID as parameter with numeric value";
        }
    

}
elseif( isset($_GET['type']) && $_GET['type'] === 'error'){
    // do something here
} 
?>



</body>
</html>

