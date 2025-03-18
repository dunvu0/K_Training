<?php session_start();?>
<!-- 
1. via php session PHPSSEID
2. via PHP_SESSION_UPLOAD_PROGRESS 
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LFI2RCE via php sessions </title>
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
        .upload-form {
            margin: 20px 0;
            text-align: center;
        }
        .upload-form input[type="file"] {
            margin: 10px 0;
        }
        .upload-form input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .upload-form input[type="submit"]:hover {
            background-color: #555;
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
            if(isset($_GET['name'])){
                $_SESSION['username'] = $_GET['name']; 
            }

            if(isset($_GET['page'])){
                include($_GET['page']);
            }else{
                echo "<p>Sorry, the page you are looking for does not exist.</p>";
            }

        
        ?>
       <div class="upload-form">
            <form action="index.php" method="post" enctype="multipart/form-data">
                <label for="file">Upload Wallpaper:</label>
                <input type="file" name="file" id="file">
                <input type="submit" name="upload" value="Upload">
            </form>
        </div>
    </div>
</body>
</html>


<?php
if(isset($_FILES['file'])){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));




    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        echo "<p>Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($extension == "php") {
        echo "hacker detected!</p>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<p>Sorry, your file was not uploaded.</p>";

    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "<p>The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.</p>";
            echo "<p>Link to the uploaded image: <a href='$target_file'>$target_file</a></p>";
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
        }
    }
}
?>
