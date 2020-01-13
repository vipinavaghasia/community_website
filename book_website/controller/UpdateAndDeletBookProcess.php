<?php
require("../model/dbconnection.php");
$BookID = $_POST['BookID'];
$AuthorID=$_POST['AuthorID'];   
/* End config */
 //updateting  book table//
if(isset($_POST['Update']))
{
  $result2 = $db->prepare("SELECT * FROM book where BookID=$BookID");
  $result2->execute();
  for($i=0; $row = $result2->fetch(); $i++)
  {
     $bt2=$row['BookTitle'];
   global $bt2;
}
  $result=$db->prepare("update book set BookTitle= '$_POST[BookTitle]', OriginalTitle='$_POST[OriginalTitle]',
  YearofPublication='$_POST[YearofPublication]',
  Genre='$_POST[Genre]',
  MillionsSold='$_POST[MillionsSold]',
  AuthorID='$_POST[AuthorID]',
  LanguageWritten= '$_POST[LanguageWritten]',
  coverImagePath='$_POST[coverImagePath]'
  WHERE BookID='$BookID'");
$result->execute();
 //updateting  author  table//
  $result=$db->prepare("update author SET Name='$_POST[Name]',
  Surname='$_POST[Surname]',
  Nationality='$_POST[Nationality]',
  BirthYear='$_POST[BirthYear]',
  DeathYear='$_POST[DeathYear]'
  where AuthorID='$AuthorID'");
  $result->execute();
  $newdate=date('Y-m-d H:i:s');
  $result=$db->prepare("update changelog SET dateChanged='$newdate' where BookID=$BookID");
  $result->execute();
  header("location:../view/pages/DisplayBook.php?message1=$bt2");
}
 //daleteting  book table record //
if(isset($_POST['Delete']))
{
  //$result=$db->prepare("select * from book where BookID='$BookID'");
       $result1 = $db->prepare("SELECT * FROM book where BookID=$BookID");
       $result1->execute();
       for($i=0; $row = $result1->fetch(); $i++)
       {
          $bt=$row['BookTitle'];
        global $bt;
       }
  $result=$db->prepare("Delete from book
  WHERE BookID='$BookID'");
  $result->execute();
// $rows=$result->fetch();
//$_SESSION["message"]="$BookID.book deleted";
  header("location:../view/pages/DisplayBook.php?message=$bt");
}
?>
