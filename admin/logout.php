<!-- destroys the session and redirects to login page -->
<?php
session_start();
session_destroy();
header("location:login.php");
?>