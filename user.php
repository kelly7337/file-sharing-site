<?php
session_start();

$_SESSION['username'] = (string) $_GET["username"];
$validUser = FALSE;

if( !preg_match('/^[\w_\-]+$/', $_SESSION['username']) ){
        header("Location:userfailure.html");
        exit;
}

//read file line by line(from wiki)
$h = fopen("/srv/module2_group_file/users.txt", "r");
while( !feof($h) ){
    if (trim(fgets($h))==$_SESSION['username']){
        $validUser = TRUE;
        break;
    }
}
fclose($h);

if($validUser){
    header("Location:main.php");
    exit;
}
else{
    header("Location:userfailure.html");
    exit;
}

?>
