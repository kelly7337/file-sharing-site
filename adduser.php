<?php
session_start();

$_SESSION['newUser'] = (string) $_GET["newUser"];

//check if the new username is valid
if( !preg_match('/^[\w_\-]+$/', $_SESSION['newUser']) ){
        header("Location:userfailure.html");
        exit;

} else {
        // add the user to users.txt
        $h = "/srv/module2_group_file/users.txt";
        $newUser = $_SESSION['newUser'];
        file_put_contents($h, $newUser, FILE_APPEND | LOCK_EX);
        $newline = "\n";
        file_put_contents($h, $newline, FILE_APPEND | LOCK_EX);

        //add the user folder to module2_group_file/uploads
        $uploadFolder = sprintf("/srv/module2_group_file/uploads/%s", $newUser);
        mkdir($uploadFolder, 0777, true);
        header("Location:usersuccess.html");
}

?>
