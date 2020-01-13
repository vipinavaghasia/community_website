<?php
session_start();
if(isset($_SESSION['role']))
{
  if($_SESSION['role']=='admin'or $_SESSION['role']=='manager')
  {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/book_website2.css">
    </head>
    <body>

      <div class="container">
        <?php
        require("../../model/dbconnection.php");
        require("../../model/dbfunction.php");
        require("../../controller/navbar.php");
        ?>
        <div class="box">
          <?php
          if (isset($_GET['link'])) {
            $link = $_GET['link'];
            switch ($link)
            {
              case "DisplayBook":
              require_once("../../controller/callbook.php"); break;
              case "AddNewBookAndAuthor":
              require_once("../../view/pages/AddNewBookAndAuthor.php"); break;
              case "RegistrationForm":
              require_once("../../view/pages/RegistrationForm.php"); break;
              case "changelog":
              require_once("../../view/pages/changelog.php"); break;

              // case "logout":
              //require("../logout.php"); break;
            }
          } else {
            require_once("../../controller/callbook.php");
          }
          require("../pages/footer.php");
        }
      }
      else{
        header('location:../../index.php');
      }
      ?>
    </div>
  </div>
</body>
</html>
