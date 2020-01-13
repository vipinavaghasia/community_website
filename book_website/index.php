<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="view/css/book_website2.css">
</head>
<body>
  <div id="header">
    <p>WELCOME TO BOOK ADVENTURE!</p>
  </div>
  <div id="user_navbar">
    <?php
    ?>
  </div>
  <div id="nav">
    <ul type="none">
    </ul>
  </div>
  <div class="container">
    <div class="content_form">
      <form action="controller/loginProcess.php" method='post'>
        <fieldset>
          <legend>
            <P class="title">Login</P>
          </legend>
          
          <label>UserName</label>
          <input  name="userName" type="text" tabindex="1"required>
          <label>Password</label>
          <input  name=" password"type="text" tabindex="1" required>
          <?php
          if(isset($_SESSION["error"])){
            $error = $_SESSION["error"];
            echo "<p>$error</p>";
          }
          ?>
          <input type="submit" value="Submit">
        </fieldset>
      </form>
    </div>
  </div>
</body>
</html>
<?php
unset($_SESSION["error"]);
?>
 <?php
  require("view/pages/footer.php");
  ?>
##addes ssh key
