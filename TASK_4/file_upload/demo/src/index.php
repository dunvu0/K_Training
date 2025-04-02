<!DOCTYPE html>
<html>
<body>

<h1><pre>Upload your images </pre></h1>
<form action="index.php" method="post" enctype="multipart/form-data">
<h3><pre>Select image to upload: </pre></h3> 
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>

<?php
if(isset($_POST["submit"])) {
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    
    // 1. Blacklist file extension: .php is dangerous
    // $ext = pathinfo($target_file,PATHINFO_EXTENSION); OR
    // $ext = explode(".", $_FILES["fileToUpload"]["name"])[1];
    // if($ext == "php"){
    //     die("Hack detected.");
    // }
    

    // 2. check if file exists
    // if(file_exists($target_file)) {
    //     die("<pre> Sorry, file already exists. </pre>");
        
    // }

    // 3. file size must less than 5mb
    // if($_FILES["fileToUpload"]["size"] > 5000000) {
    //     die("<pre> Sorry, your file is too large. </pre>");
    // }


    // 4. valid image must has mime type: image/png
    // if($_FILES["fileToUpload"]["type"] != "image/png"){
    //     die("<pre> Only image allowed </pre>");
    // }


    // 5. check mime type - validate by magic bytes
    // $finfo = finfo_open(FILEINFO_MIME_TYPE);
    // $mime_type = finfo_file($finfo, $_FILES["fileToUpload"]["tmp_name"]);
    // finfo_close($finfo);
    // if($mime_type !== "image/jpg" && $mime_type !== "image/jpeg") {
    //     die("<pre> only JPEG images are allowed. </pre>");
    // }
    

    // 6. check valid image w/ getimagesize() 
    // $image_size = getimagesize($_FILES['fileToUpload']['tmp_name']);
    // var_dump($image_size);
    // if ($image_size === false) {
    //     die("<pre> not image </pre>");
    // }


    // 7. resize image 
    function resize($imagePath, $outputPath, $width, $height) {
        try {
            $imagick = new Imagick($imagePath);
            $imagick->thumbnailImage($width, $height, true, true); 
            $imagick->writeImage($outputPath); // Save the resized image
            $imagick->clear();
            $imagick->destroy();
        } catch (Exception $e) {
            echo "<pre>Error resizing image: " . $e->getMessage() . "</pre>";
            unlink($imagePath);
        }
    }

    // 8. race condition
    function is_malware($file_path){
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file_path);
        finfo_close($finfo);
        if($mime_type != "image/jpg" && $mime_type != "image/jpeg" && $mime_type != "image/png") {
            return true;
        } 
        return false;
    }

    function is_image($file_path){
        $image_size = getimagesize($file_path);
        if ($image_size === false) {
            return false;
        }
        return true;
    }

    $upload_path = "./uploads/";
    $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    $filename = basename($_FILES["fileToUpload"]["name"], "." . $ext);
    $timestamp = time();
    $new_name = $filename . '_' . $timestamp . '.' . $ext;
    $upload_dir = $upload_path . $new_name;
    if ($_FILES['fileToUpload']['size'] <= 5000000) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_dir);
    }

    // check valid image
    if(is_image($upload_dir) && !is_malware($upload_dir)){
        echo "<pre> Everything is OK </pre>";
        resize($upload_dir, $upload_dir, 500, 500);
        echo "<pre> file has been uploaded at <a href = $upload_dir>here</a>";
    } else{
        unlink($upload_dir);
        die("Hack detected.");
    }

}


// if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//     echo "<pre>The file '".basename($_FILES["fileToUpload"]["name"]). "' has been uploaded at " ."<a href='$target_file'>here</a> </pre>";
    
//     // 7. Resize the image to 50x50
//     // @resize($target_file, "./uploads/test_after.php", 500,500 );

    
// } else {
//     echo "<pre> Sorry, there was an error uploading your file. </pre>";  
// }
?>


</body>
</html>