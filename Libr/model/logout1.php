<?php
    session_start();
    include 'connection_db.php';

// Put some rate limits & domain locking

    
    if(isset($_POST['logout'])) {
      unset($_SESSION["studentId"]);
      
      echo json_encode(Array('login'=>false));
      die();
         header('Location: ../index.html');
    }
?>
