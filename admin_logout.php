<?php
session_start();
session_unset();
session_destroy();

// Redirect to home page
header("Location: index.html"); // Change to your home page file if different
exit();
?>
