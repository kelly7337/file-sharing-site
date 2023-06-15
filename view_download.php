<?php

//User can view and download the files

session_start();

//(from wiki)
$filename = $_POST['file'];

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo htmlentities("Invalid filename");
        exit;
}

$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo htmlentities("Invalid username");
        exit;
}

$full_path = sprintf("/srv/module2_group_file/uploads/%s/%s", $username, $filename);

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);

header("Content-Type: ".$mime);
header('content-disposition: inline; filename="'.$filename.'";');
readfile($full_path);

?>
