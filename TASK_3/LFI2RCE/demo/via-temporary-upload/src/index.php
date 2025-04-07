<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> LFI2RCE via temporary file uploaded </title>
  
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
