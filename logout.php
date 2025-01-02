<?php
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect to home page
header("Location: index.php");
exit();
?>
