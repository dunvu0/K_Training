<?php
session_start();
require_once 'config.php';

// Check if user is already logged in
if(isset($_SESSION['username'])) {
  header('Location: home.php');
  exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username']; 
  $password = $_POST['password'];
  

  $sql = "SELECT * FROM users WHERE username = '$username'";
  
  try {
    $stmt = $conn->query($sql);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user && password_verify($password, $user['password'])) {
      // Stored XSS
      $_SESSION['username'] = $username; 
      $_SESSION['id'] = $user['id'];
      header('Location: home.php');
      exit;
    } else{
      die("Invalid username or password");
    }
  } catch(PDOException $e) {
    die("Database error: " . $e->getMessage() );
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 400px;
      margin: 50px auto;
      background-color: #f8f9fa;
      color: #333;
    }
    .container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 25px;
    }
    h2 {
      color: #2c3e50;
      margin-top: 0;
      margin-bottom: 20px;
      border-bottom: 2px solid #eee;
      padding-bottom: 10px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label {
      margin-top: 10px;
      color: #555;
    }
    input[type="text"],
    input[type="password"] {
      padding: 12px;
      font-size: 1em;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-top: 5px;
    }
    button {
      margin-top: 20px;
      padding: 12px;
      font-size: 1em;
      cursor: pointer;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 4px;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #2980b9;
    }
    p {
      margin-top: 20px;
      text-align: center;
    }
    a {
      color: #3498db;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>

    <form action="login.php" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required >

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register</a></p>
  </div>
</body>
</html>
