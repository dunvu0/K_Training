<?php
// error_reporting(0);
session_start();
include "./conn.php";
include "./class.php";


if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = ($_POST["username"]);
    $password = ($_POST["password"]);
    $password = md5($password);

    $query = "SELECT * FROM users WHERE username ='$username' AND password='$password' ";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("<br> MySQL error: " . mysqli_error($conn) . "</br>");
    } else {
        $rows = $result->fetch_assoc();
        if ($rows == 0) {
            die("<br> Something wrong... try again</br>");
        } else {

            $_SESSION['username'] = $rows['username'];


            
            $user = new User($username, $password);
            setcookie("user_data", base64_encode(serialize($user)), time() + (24* 60 * 60));
            header("Location: home.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <div class="container" id="signIn">
        <h1 class="form-title">Login</h1>
        <form method="post" action="login.php">
          	<div class="input-group">
            	<input type="text" name="username" id="username" placeholder="Username" required>
         	</div>
         	<div class="input-group">
             	<input type="password" name="password" id="password" placeholder="Password" required>
         	</div>
        
        <input type="submit"  value="Sign In" name="signIn">
        </form>
    </div>



</body>
</html>




