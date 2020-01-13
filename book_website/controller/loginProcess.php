<?php
session_start();
require("../model/dbconnection.php");
require("../model/dbfunction.php");
require("../controller/inputFilter.php");

if(!empty([$_POST]))
{
  $username=!empty($_POST['userName'])? inputFilter(($_POST['userName'])):NULL;
  $password=!empty($_POST['password'])? inputFilter(($_POST['password'])):NULL;
  //checking password and username
  try{
    $stmt=$db->prepare("select * from login where userName=:user");
    $stmt->bindParam(':user',$username);
    $stmt->execute();                          
    $rows =$stmt->fetch();
    if(password_verify($password, $rows['password']))
    {
//assign session veriable
      $_SESSION["userName"]=$username;
      $_SESSION["loginID"]=$rows["loginID"];
      $_SESSION["role"]=$rows["role"];
      $_SESSION["login"]=true;
//redirect page to main page
      header('location:../view/pages/DisplayBook.php');
    }
    else{
      //password or username not match go back to login page
      $_SESSION["error"]="incorrect user Name or password";
      header('location:../index.php');
    }
  }
  catch(PDOException $ex)
  {
    $ex->getMessage();
    die();
  }
}

?>
