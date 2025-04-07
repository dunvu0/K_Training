<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LFI2RCE via pearcmd.php </title>
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

        
        ?>

    </div>
</body>
</html>
