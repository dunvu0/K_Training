<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

// Check if user is already logged in
if(isset($_SESSION['username'])) {
  header('Location: home.php');
  exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username']; 
  $password = $_POST['password'];
  
  
  if(empty($username) || empty($password)) {
    $error = "Username and password are required";
  } else {
    try {
      // Check if username already exists 
      $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
      $stmt->execute([$username]);
      
      if($stmt->rowCount() > 0) {
        $error = "Username already exists";
      } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
    
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed_password]);
        
        $success = "Registration successful! You can now <a href='login.php'>login</a>";
      }
    } catch(PDOException $e) {
      $error = "Database error: " . $e->getMessage();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
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
    .error {
      color: #e74c3c;
      margin-top: 15px;
      padding: 10px;
      background-color: #fadbd8;
      border-radius: 4px;
    }
    .success {
      color: #27ae60;
      margin-top: 15px;
      padding: 10px;
      background-color: #d4efdf;
      border-radius: 4px;
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
    <h2>Register</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?= $error ?></div> 
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="success"><?= $success ?></div> 
    <?php else: ?>
      <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password"  id="password"  name="password" required>

        <button type="submit">Register</button>
      </form>
    <?php endif; ?>

    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>
</body>
</html>
