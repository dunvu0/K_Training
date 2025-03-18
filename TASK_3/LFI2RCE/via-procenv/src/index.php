
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LFI2RCE via /proc</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav {
            margin: 20px;
            text-align: center;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to My Website</h1>
    </header>
    <nav>
        <a href="?page=home.php">Home</a>
        <a href="?page=about.php">About</a>
        <a href="?page=contact.php">Contact</a>
    </nav>
    <div class="content">
        <?php
            if(isset($_GET['page'])){
                include($_GET['page']);
            }else{
                echo "<p>Sorry, the page you are looking for does not exist.</p>";
            }

            phpinfo();
        ?>
    </div>
</body>
</html>
