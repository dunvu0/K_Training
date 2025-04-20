<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

$username = $_SESSION['username'];

// Sample users 
$users = [
  ['username' => 'admin', 'score' => 1500],
  ['username' => 'john_doe', 'score' => 1200],
  ['username' => 'alice123', 'score' => 950],
  ['username' => $username, 'score' => 600], // Current user
  ['username' => 'hihi', 'score' => 580],
];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Rankings</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f8f9fa;
      color: #333;
    }
    h1 {
      color: #2c3e50;
      margin-bottom: 30px;
      text-align: center;
    }
    .ranking-container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      padding: 25px;
    }
    .ranking-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .ranking-table th, 
    .ranking-table td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }
    .ranking-table tr:last-child td {
      border-bottom: none;
    }
    .ranking-row:hover {
      background-color: #f5f5f5;
    }
    .username-column {
      width: 70%;
    }
    .score-column {
      width: 30%;
    }
    .current-user {
      background-color: #fffde7;
      font-weight: bold;
    }
    .nav {
      margin-top: 20px;
      text-align: center;
    }
    .nav a {
      display: inline-block;
      margin: 0 10px;
      color: #3498db;
      text-decoration: none;
    }
    .nav a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>
  <div class="ranking-container">
    <h1>User List</h1>
    
    <table class="ranking-table">
        <tr>
          <th class="username-column">Username</th>
          <th class="score-column">Score</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['score']; ?></td>
          </tr>
        <?php endforeach; ?>
    </table>
    
    <div class="nav">
      <a href="home.php">Home</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>
</html>
