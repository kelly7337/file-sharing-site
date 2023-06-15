<?php
    session_start();
    $username= (string) $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="file.css" type="text/css" rel="stylesheet" >
    <title>File Share</title>
</head>
<body>

    <h1>  <?php echo htmlentities("$username");?> 's account </h1>
    <h2> Enter your friend's name and share the file with him/her!</h2>
    //User can log out the account
    <div id="logout">
        <form action="logout.php" method="GET">
         <p> Want to logout? </p>
         <input type="submit" value="Logout">
        </form>
    </div>
    <br>

    //User can upload files
    <div id="leftform">
    <h2>Upload Files</h2>
    <p>(File name can't include space!) </p>
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose file:</label>
            <input name="uploadedfile" type="file" id="uploadfile_input"/>
        </p>
        <p>
            <input id="uploadbutton" type="submit" value="Upload File" />
        </p>
    </form>
    </div>


    <div id="files">
    <h2> Your Files </h2>
    <?php

    //Show a user's files
    $filepath=sprintf("/srv/module2_group_file/uploads/%s/", $username);
    $fileArray= scandir($filepath);

    echo "<ul>\n";

    for ($x=2; $x<count($fileArray); $x++){
        printf("\t\t<li>%s",
        htmlentities($fileArray[$x])
        );

    //User can view and download their files
        echo "\n\t\t\t<form action='view_download.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='submit' value='View File'>
        \t</form>";

    //User can delete the files
        echo "\n\t\t\t<form action='deletefile.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='submit' value='Delete'>
        \t</form>";


    //User can share their files with other users
        echo "\n\t\t\t<form action='share.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='text' name='usershare'>
        \t\t<input type='submit' value='Share'>
        \t</form>
        ";
        print("</li>\n");
    }
    echo "\t</ul>\n";
    ?>
    </div>


</body>
</html>
