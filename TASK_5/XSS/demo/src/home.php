<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

$username = $_SESSION['username']; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f8f9fa;
      color: #333;
    }
    .render-section {
      margin-top: 30px;
      border-top: 1px solid #eee;
      padding-top: 20px;
    }
    .section-title {
      color: #2c3e50;
      margin-bottom: 15px;
    }
    textarea {
      width: 100%;
      height: 150px;
      margin-bottom: 15px;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-family: monospace;
      resize: vertical;
    }
    .btn {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }
    .btn:hover {
      background-color: #2980b9;
    }
    .output-area {
      border: 1px solid #ddd;
      padding: 15px;
      margin-top: 20px;
      background-color: #f9f9f9;
      border-radius: 4px;
    }
    .output-title {
      font-size: 18px;
      margin-bottom: 10px;
      color: #2c3e50;
    }
    .logout {
      margin-top: 30px;
      text-align: right;
    }
    .logout a {
      color: #3498db;
      text-decoration: none;
    }
    .logout a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- Stored XSS  -->
  <h1>  Welcome <?php echo $username ?>! </h1>

  <div class="render-section">
    <h2 class="section-title">Render HTML</h2>     
    <form method="post" action="home.php">
      <textarea name="html_code" placeholder="<h1>Your HTML here</h1>"> </textarea>
      <button type="submit" class="btn">Render</button>
    </form>
    
    <!-- Reflected XSS  -->        
    <h3 class="output-title">Output:</h3>
    <div class="output-area">
      <?php
      if(isset($_POST['html_code'])) {
        $renderedHtml = $_POST['html_code'];
        echo "<pre> $renderedHtml </pre>";
      } 
      ?>
    </div>
  </div>
  <div class="logout">
    <a href="logout.php">Logout</a>
  </div>
</body>
</html> 


