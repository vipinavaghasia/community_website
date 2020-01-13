<?php
session_start();
include('connection_db.php');
//if(isset($_POST['logout'])) {
    unset($_SESSION["studentId"]);
//     echo json_encode(array("Login" =>"false"));
//      die();
    header('Location: ../index.html');
//}
session_destroy();
?>
