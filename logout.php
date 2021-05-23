<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION["userID"]);
unset($_SESSION["username"]);
unset($_SESSION["given"]);
unset($_SESSION["course"]);
unset($_SESSION["admin"]);


session_destroy();
header( 'Location: index.php' );


