<?php
session_start();
require("../model/dbconnection.php");
require("../model/dbfunction.php");

require("../controller/inputFilter.php");
if(!empty([$_POST])){
  //INPUT SANNITATION VIA TESTINPUT FUNCTION
  //set default bookcover
  $defaultbookcover="../images/Default.jpg";
  //Author detail
  $Name=!empty($_POST['Name'])? inputFilter(($_POST['Name'])):NULL;
  $Surname=!empty($_POST['Surname'])? inputFilter(($_POST['Surname'])):NULL;
  $Nationality=!empty($_POST['Nationality'])?inputFilter(($_POST['Nationality'])):NULL;
  $BirthYear=!empty($_POST['BirthYear'])?inputFilter(($_POST['BirthYear'])):NULL;
  $DeathYear=!empty($_POST['DeathYear'])?inputFilter(($_POST['DeathYear'])):NULL;
//Book detail
  $BookTitle=!empty($_POST['BookTitle'])?inputFilter(($_POST['BookTitle'])):NULL;
  $OriginalTitle=!empty($_POST['OriginalTitle'])?inputFilter(($_POST['OriginalTitle'])):NULL;
  $YearofPublication  =!empty($_POST['YearofPublication'])?inputFilter(($_POST['YearofPublication'])):NULL;
  $Genre =!empty($_POST['Genre'])?inputFilter(($_POST['Genre'])):NULL;
  $MillionsSold=!empty($_POST['MillionsSold'])?inputFilter(($_POST['MillionsSold'])):NULL;
  $LanguageWritten=!empty($_POST['LanguageWritten'])?inputFilter(($_POST['LanguageWritten'])):NULL;
  $coverImagePath=!empty($_POST['coverImagePath'])?inputFilter(($_POST['coverImagePath'])):$defaultbookcover;
  //asign veriable to session_login
  $mylogin= $_SESSION['loginID'];
  //selecting data from users table
  $query=$db->prepare("SELECT * FROM users where userID=$mylogin");
  //  $query=$db->prepare("SELECT * FROM users where userID='$userID'");
  $query->execute();
  $row=$query->fetch();
  $userID=$row['userID'];
  // SQL statements check name is not already in the database//
  $query=$db->prepare("select AuthorID,Name from author where Name=:Name");
  $query->bindvalue(":Name",$Name);
  $query->execute();
  $rows=$query->fetch();
  if($query->rowcount()>0)//if row  found
  {
    $Author = $rows['AuthorID'];
    addBook($BookTitle,$OriginalTitle,$YearofPublication,$Genre,$MillionsSold,$LanguageWritten,
    $Author,$coverImagePath,$userID);
    header('location:../view/pages/DisplayBook.php');
  }
  else{
    addAuthorAndBook($Name,$Surname,$Nationality,$BirthYear,$DeathYear,$BookTitle,$OriginalTitle,
    $YearofPublication,$Genre,$MillionsSold, $LanguageWritten,$coverImagePath,$userID);
    //redirect page to main page
    header('location:../view/pages/DisplayBook.php');
  }
}
?>
