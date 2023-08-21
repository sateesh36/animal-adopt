<?php 

session_start();
session_destroy();

header("Location: ../normaluser/lognregister.php");

?>