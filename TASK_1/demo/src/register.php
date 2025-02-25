<?php
    //secure register
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) ){
    if($_POST["password"] !== $_POST["confirm_password"]){
        echo "password mismatch";
        exit();
    }else{
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = md5($password);

        $db = new PDO("mysql:host=db;dbname=demo", "root", "root");

        //if user already exist
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(["username" => $username]);
        if($stmt->rowCount() > 0){
            echo "Username already exist!";
            exit();
        } else{
            $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute([
                "username" => $username,
                "password" => $password
            ]);

            header("Location: index.php?page=login");
        }


    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="post">
            <div class="input-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            </div>
            <input type="submit" value="Register">
        </form>
    </div>


</body>
</html>