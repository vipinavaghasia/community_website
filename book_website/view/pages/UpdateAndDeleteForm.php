<?php
session_start();
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
    <div class="sampleFormBox">
      <?php
      require("../../model/dbconnection.php");
      $BookID = $_GET['bid'];
      $AuthorID=$_GET['aid'];
      $result = $db->prepare("SELECT * from book where BookID = $BookID ");
      $result->execute();
      $result2 = $db->prepare("SELECT * from author where AuthorID = $AuthorID ");
      $result2->execute();
      for($i=0; $row = $result->fetch(); $i++){
        echo '<form action="../../controller/UpdateAndDeletBookProcess.php" method = "POST" >
        <fieldset>
        <legend>
        <p class="title">You are about edit book id:'.$row["BookID"].'  </p>
        </legend>
        <input name="BookID" value="'.$row["BookID"].'"   type="hidden"  required>
        <label>BookTitle</label>
        <input name="BookTitle" value="'.$row["BookTitle"].'"   type="text"  required>
        <label>OriginalTitle</label>
        <input name="OriginalTitle" value="'.$row["OriginalTitle"].'"  type="text"  required>
        <label>YearofPublication</label>
        <input name="YearofPublication" value="'.$row["YearofPublication"].'" type="text"   required >
        <label>Genre</label>
        <input name="Genre" value="'.$row["Genre"].'"  type="text"   required >
        <label>MillionsSold</label>
        <input name="MillionsSold"  value="'.$row["MillionsSold"].'"     type="text"   required>
        <label>AuthorID</label>
        <input name="AuthorID" value="'.$row["AuthorID"].'"   type="text"    required>
        <label>LanguageWritten</label>
        <input name="LanguageWritten" value="'.$row["LanguageWritten"].'"  type="text"    required >
        <label>coverImagePath</label>
        <input name="coverImagePath" value="'.$row["coverImagePath"].'"   type="text"    placeholder="coverImagePath">';
      }
      for($i=0; $row = $result2->fetch(); $i++){
        echo'  <legend>
        <p class="title">Add New Author information</p>
        </legend>
        <label>Name:</label>
        <input  name="Name"   value="'.$row["Name"].'" type="text"  required>
        <label>Surname:</label>
        <input  name="Surname"  value="'.$row["Surname"].'"   type="text"  required>
        <label>Nationality:</label>
        <input name="Nationality"    value="'.$row["Nationality"].'"  type="text"  required>
        <label>BirthYear:</label>
        <input name="BirthYear" value="'.$row["BirthYear"].'"  type="text"  required>
        <label>DeathYear:</label>
        <input  name="DeathYear" value="'.$row["DeathYear"].'"  type="text"  required>
        <input type ="submit" name="Update" value="Update">
        <input type ="submit" name="Delete" value="Delete">
        </fieldset>
        </form>';
      }
      ?>
    </div>
  </div>
  <?php
  require("../pages/footer.php");
  ?>
</body>
</html>
