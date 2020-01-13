<?php
session_start();
session_unset();
session_destroy();
//redirect to entry page after logout
header('location:index.php');
?>
