<?php
//user can share their files with other users
session_start();
$username = $_SESSION['username'];
$filename = $_POST['file'];
$shareuser = (string) $_POST['usershare'];
$validUser = FALSE;

//Find the sharing name
if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo htmlentities("Invalid username");
        exit;
}

//Find the receiving name
if( !preg_match('/^[\w_\-]+$/', $shareuser) ){
    header("Location:failure.html");
        exit;
}

$file = sprintf("/srv/module2_group_file/uploads/%s/%s", $username, $filename);

//Shared file already exist!
$h = fopen("/srv/module2_group_file/users.txt", "r");
while( !feof($h) ){
    if (trim(fgets($h))==$shareuser){
        $validUser = TRUE;
        break;
    }
}
fclose($h);

//Share the file
if($validUser){
    $shareuserFolder = sprintf("/srv/module2_group_file/uploads/%s/%s", $shareuser, $filename);
    copy ($file, $shareuserFolder);
    header("Location:success.html");
    exit;
}
else{
    header("Location:sharefailure.html");
    exit;
}

?>
