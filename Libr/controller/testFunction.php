<?php

include('../model/session_manager.php');
include('inputFilter.php');

try{

    //session is not start
    if(session_id() == "" || !isset($_SESSION)){
  session_start();
  //current date
  $date = date('Y-m-d H:i:s');
  //if no sessionClass object
  if(!isset($_SESSION['sessObj'])){
    $_SESSION['sessObj'] = new sessionClass;
  }
  //CHECK MORE THAN 10 REQUEST IN 24 HOURS
     if($_SESSION['sessObj']->check_24h()== true){
      throw new Exception('wrong 24 hours');

      }
      //check per request per second
      elseif($_SESSION['sessObj']->check_lsecond()== true){
      throw new Exception('rate limit per second');

      }

       // check referer
      elseif($_SESSION['sessObj']->domainLocked()== true){
      throw new Exception('wrong referer');

      }

  if(isset($_GET['request_function'])){
    $dbFunObj = new dbFunctiondClass;
    //slect student data
    if($_GET['request_function'] =='selectbook'){
      $dbFunObj -> selectbook();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'selectbook');
    }
      //
      else if($_GET['request_function'] =='pro'){
      $dbFunObj -> pro();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'pro');
    }
      ///
      
      else if($_GET['request_function'] =='Staff'){
      $dbFunObj -> Staff();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'Staff');
    }
      
      
      
      
      
      else if($_GET['request_function'] =='Borro'){
          
       $defaultLStaffId="null";
          $defaultreturndate="null";
           $studentId=$_SESSION["studentId"];
$BookBorrowingDate = date('Y-m-d H:i:s');
          $BookBorrrowingDueDate = date("Y-m-d",strtotime("+15 day")); 
     //$BookBorrrowingDueDate= date('Y-m-d H:i:s');
          
      
          
          
         $BookReturnDate= date("Y-m-d",strtotime("+10 day")); 
      $bookId = !empty($_POST['bookId'])? inputFilter(($_POST['bookId'])): null;
       $LStaffId = !empty($_POST['LStaffId'])? inputFilter(($_POST['LStaffId'])): $defaultLStaffId;
            $dbFunObj -> Borro($studentId,$LStaffId , $bookId, $BookBorrowingDate, $BookBorrrowingDueDate,$BookReturnDate);
         
          
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'Borrow');
    }
      
      
      else if($_GET['request_function'] =='Borrowing'){
      
      $dbFunObj -> Borrowing();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'Borrowing');
      
      
      }
      
      
      
    // display staff data(user)
    else if($_GET['request_function'] =='staff'){
      $dbFunObj -> staff();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'staff');
    }
    //display log data
    else if($_GET['request_function'] == 'selectlog'){
      $dbFunObj -> selLog();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'selLog');

    }
    //display book category
    else if($_GET['request_function'] =='bookcat'){
      $dbFunObj -> bookcat();
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'bookcat');
    }


    //add book category
    else if($_GET['request_function'] =='addcat'){
      $BookCatName  = !empty($_POST['BookCatName'])? inputFilter(($_POST['BookCatName'])): null;
      if(validate($BookCatName,'char') == false)
      {
        throw new Exception('Data invalidate');
      }
      $dbFunObj -> addcat($BookCatName);
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'addcat');

    }
    //add staff data
    else if($_GET['request_function'] == 'addstaff'){
      $StaffName  = !empty($_POST['StaffName'])? inputFilter(($_POST['StaffName'])): null;
      $StaffLastName = !empty($_POST['StaffLastName'])? inputFilter(($_POST['StaffLastName'])): null;
      $StaffEamil = !empty($_POST['StaffEamil'])? inputFilter(($_POST['StaffEamil'])): null;
      $StaffPhone = !empty($_POST['StaffPhone'])? inputFilter(($_POST['StaffPhone'])): null;
      $password = !empty($_POST['staffpassword'])? inputFilter(($_POST['staffpassword'])): null;
      $password=password_hash($password,PASSWORD_DEFAULT);

      //validate data
      if(validate($StaffName,'char') == false || validate($StaffLastName,'char') == false
      || validate($StaffPhone,'int')  == false )
      {
        throw new Exception('Data invalidate');
      }

      $dbFunObj -> addUser($StaffName, $StaffLastName, $StaffEamil, $StaffPhone,$password);
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'addUser');

    }

    //login process

    else if($_GET['request_function'] =='addlogin'){


      $Email = !empty($_POST['Email'])? inputFilter(($_POST['Email'])): null;

      $password = !empty($_POST['password'])? inputFilter(($_POST['password'])): null;


      $dbFunObj -> Login($Email, $password);
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'Login');
    }
///
else if($_GET['request_function'] =='Logout'){
$dbFunObj -> Logout();
      }
      
      
      
      //////////////
else if($_GET['request_function'] == 'islogin'){
  if ($_SESSION['islogin'] != 'true'){
      echo json_encode(Array("islogin"=>"false"));
  }else{
      echo json_encode(Array("islogin"=>"true"));
  }
}

////////////////Logout





     //Update student data
      else if($_GET['request_function'] == 'Update'){
      $Name = !empty($_POST['Name'])? inputFilter(($_POST['Name'])): null;
      $lastName = !empty($_POST['lastName'])? inputFilter(($_POST['lastName'])): null;
      $Email = !empty($_POST['Email'])? inputFilter(($_POST['Email'])): null;
      $PhoneNo = !empty($_POST['PhoneNo'])? inputFilter(($_POST['PhoneNo'])): null;
      $address = !empty($_POST['address'])? inputFilter(($_POST['address'])): null;
      $dbFunObj -> Update($Name, $lastName, $Email,  $PhoneNo, $address);
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'Update');
      }
    //Student Register

    else if($_GET['request_function'] == 'Register'){
      $Name = !empty($_POST['Name'])? inputFilter(($_POST['Name'])): null;
      $lastName = !empty($_POST['lastName'])? inputFilter(($_POST['lastName'])): null;
      $Email = !empty($_POST['Email'])? inputFilter(($_POST['Email'])): null;
      $PhoneNo = !empty($_POST['PhoneNo'])? inputFilter(($_POST['PhoneNo'])): null;
      $address = !empty($_POST['address'])? inputFilter(($_POST['address'])): null;
      $password = !empty($_POST['password'])? inputFilter(($_POST['password'])): null;
      $password=password_hash($password,PASSWORD_DEFAULT);
      // validate data
      if(validate($Name,'char') == false || validate($lastName,'char') == false || validate($PhoneNo,'int')  == false)
      {
        throw new Exception('Data invalidate');
      }
      $dbFunObj -> Register($Name, $lastName, $Email,  $PhoneNo, $address, $password);
      $_SESSION['sessObj'] -> logRequest($_SERVER['HTTP_REFERER'], $date, 'Register');
    }
    else {
      throw new Exception('Worng request paramater');
    }
  }else{
    header('Content-Type:application/json');
    echo json_encode(Array("error"=>"false"));
  }
    }
}catch(Exception  $e){

  header('Content-Type:application/json');
  echo json_encode(Array("error"=>$e->getMessage()));
}

?>
