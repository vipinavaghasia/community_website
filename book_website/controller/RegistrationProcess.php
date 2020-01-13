<?php

require("../model/dbconnection.php");
require("../model/dbfunction.php");
require("../controller/inputFilter.php");
if(!empty([$_POST])){
  //INPUT SANNITATION VIA TESTINPUT FUNCTION
  $userName=!empty($_POST['UserName'])?inputFilter(($_POST['UserName'])):NULL;
  $password=!empty($_POST['password'])?inputFilter(($_POST['password'])):NULL;
  $role=!empty($_POST['Role'])?inputFilter(($_POST['Role'])):NULL;
  $firstName=!empty($_POST['FirstName'])?inputFilter(($_POST['FirstName'])):NULL;
  $lastName=!empty($_POST['LastName'])?inputFilter(($_POST['LastName'])):NULL;
  $email=!empty($_POST['email'])?inputFilter(($_POST['email'])):NULL;
//password_hash
  $password=password_hash($password,PASSWORD_DEFAULT);
  newAdminUser($userName,$password,$role,$firstName,$lastName,$email);  // function call
  header('location:../view/pages/DisplayBook.php');
}
?>
<!--  -->
