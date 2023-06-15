<?php
//User can logout
session_start();
session_destroy();
header("Location:login.html");
?>
