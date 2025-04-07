<?php 
phpinfo();

$imgInfo = getimagesize(file_get_contents($file));
if ($imgInfo == NULL){
    echo "img not valid"
}


?>