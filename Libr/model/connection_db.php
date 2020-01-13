<?php

$date = date('Y-m-d H:i:s');
class dbFunctiondClass{
  private $conn;
  //class of conect with database
  public function __construct(){
    $this -> conn = new PDO("mysql:host=localhost;dbname=library;port=3306", 'root', '');
    $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this -> conn -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }
  //login function
  public function Login($Email, $password){
    try{
      $sql = "SELECT * FROM student WHERE Email = :E";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->bindParam(':E',$Email);
      $stmt->execute();
      $rows=$stmt->fetch();
      if(password_verify($password, $rows['password']))
      {
        //assign session veriable
       
        $_SESSION["studentId"]=$rows["studentId"];
           $_SESSION['islogin']='true';
        
        //$json['success']='welcome'.$rows["Name"];
        header('Content-Type:application/json');
        //echo json_encode($json);
          echo json_encode(array("Login" =>"true"));
          }
      else
      {  
        echo json_encode(array("Login" =>"false"));
      }
    }
    catch(PDOException  $e){
      echo 'PDOException: ' . $e->getMessage();
    }
  }







    ///
    public function Borrowing(){
    try{        
    $st=$_SESSION['studentId'];
      global $bookId;  
    $sql = "SELECT book.`BookTitle`,student.Name,student.lastName,bookborrowingrecord.BookBorrowingDate,
    bookborrowingrecord.BookBorrrowingDueDate FROM `bookborrowingrecord` 
INNER JOIN book on book.bookId=bookborrowingrecord.bookId
INNER JOIN student ON student.studentId=bookborrowingrecord.studentId
WHERE bookborrowingrecord.studentId=$st";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->execute();
      $q = array();
      $std=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($std as $row){
        $q[] = $row;
      }
      header('Content-Type:application/json');
      echo json_encode($q);
    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
    
    
    
    ///
    public function pro(){
    try{
        
        $st=$_SESSION['studentId'];
      $sql = "SELECT * FROM student where studentId=$st";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->execute();
      $q = array();
      $std=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($std as $row){
        $q[] = $row;
      }
      header('Content-Type:application/json');
      echo json_encode($q);
    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
    
    

  //Register function
  public function Register($Name,$lastName,$Email,$PhoneNo,$address, $password)
  {
    try{
      $sql = "INSERT INTO student(Name,lastName,Email,PhoneNo,address,password)
      VALUES (:N, :l, :e, :p, :a, :pass)";
      $stmt = $this -> conn -> prepare($sql);
      $stmt -> bindValue(':N', $Name);
      $stmt -> bindValue(':l',  $lastName);
      $stmt -> bindValue(':e', $Email);
      $stmt -> bindValue(':p', $PhoneNo);
      $stmt -> bindValue(':a', $address);
      $stmt -> bindValue(':pass', $password);
      $stmt->execute();
      //echo $sql. '</br>';
      $json['message']='sucessfully register';
      header('Content-Type:application/json');
      echo json_encode($json);

    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
    /////
    
    public function Borro($studentId,$LStaffId,$bookId, $BookBorrowingDate, $BookBorrrowingDueDate, $BookReturnDate)
  {
    try{
        global $bookId;
        date_default_timezone_set('Australia/Brisbane');
        $date = date('Y-m-d H:i:s');
         $ID=$_SESSION['studentId'];
      $sql = "INSERT INTO bookborrowingrecord(studentId, LStaffId,bookId, BookBorrowingDate,BookBorrrowingDueDate,BookReturnDate)
      VALUES (:s,:L, :b, :bbd, :d,:r)";
      $stmt = $this -> conn -> prepare($sql);
      $stmt -> bindValue(':s', $ID);
      $stmt -> bindValue(':L',    $LStaffId);
      $stmt -> bindValue(':b', $bookId);
      $stmt -> bindValue(':bbd',    $date);
      $stmt -> bindValue(':d',    $BookBorrrowingDueDate);
        $stmt -> bindValue(':r',   $BookReturnDate);
      
      $stmt->execute();
      //echo $sql. '</br>';
      $json['message']='sucessfully borrowing ';
      header('Content-Type:application/json');
      echo json_encode($json);

    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //Update STUDENT RECORED
        
    public function Update($Name,$lastName,$Email,$PhoneNo,$address)
  {
    try{
        $ID=$_SESSION["studentId"];
      $sql = "update student SET Name='$Name',lastName='$lastName',
      Email='$Email',
      PhoneNo='$PhoneNo',
      address='$address'
      WHERE studentId='$ID'";
      
      $stmt = $this -> conn -> prepare($sql);
      
      $stmt->execute();
     
      $json['message']='sucessfully UPDATE';
      header('Content-Type:application/json');
      echo json_encode($json);

    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
  //////Staff  
    
    public function Staff(){
    try{
      $sql = "SELECT * FROM libsataff";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->execute();
      $q = array();
      $std=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($std as $row){
        $q[] = $row;
      }
      header('Content-Type:application/json');
      echo json_encode($q);
    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
    
    
    
    
  //select student data
  public function selectbook(){
    try{
      $sql = "SELECT * FROM book";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->execute();
      $q = array();
      $std=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($std as $row){
        $q[] = $row;
      }
      header('Content-Type:application/json');
      echo json_encode($q);
    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
  //adding log data
  public function addLog($ipAddress, $browser, $time, $action){
    try{
      $sql = "INSERT INTO log(ipAddress, browser, time, action)
      VALUES (:ipAddress, :browser, :time, :action)";
      $stmt = $this -> conn -> prepare($sql);
      $stmt -> bindValue(':ipAddress', $ipAddress);
      $stmt -> bindValue(':browser', $browser);
      $stmt -> bindValue(':time', $time);
      $stmt -> bindValue(':action', $action);
      $stmt->execute();

    }catch(PDOException  $e){
      throw new Exception($e->getMessage());
    }
  }
  //---------------------
  //select all of Log
  public function selLog(){
    try{
      $sql = "SELECT * FROM log";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->execute();
      $arr = array();
      $log_list=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($log_list as $row){
        $arr[] = $row;
      }
      header('Content-Type:application/json');
      echo json_encode($arr);

    }catch(PDOException  $e){
      echo 'PDOException:' . $e->getMessage();
    }
  }
  //add user(staff data)
  public function addUser($StaffName, $StaffLastName, $StaffEamil, $StaffPhone,$password){
    try{

      $sql = "INSERT INTO libsataff(StaffName, StaffLastName, StaffEamil, StaffPhone,staffpassword)
      VALUES (:stn, :stl, :ste, :stp,:stpass)";
      $stmt = $this -> conn -> prepare($sql);
      $stmt -> bindValue(':stn', $StaffName);
      $stmt -> bindValue(':stl', $StaffLastName);
      $stmt -> bindValue(':ste', $StaffEamil);
      $stmt -> bindValue(':stp', $StaffPhone);
      $stmt -> bindValue(':stpass',$password);
      $stmt->execute();
      header('Content-Type:application/json');
      echo json_encode("user created");
    }catch(PDOException  $e){
      throw new Exception($e->getMessage());
    }
  }
  //select book category
  public function bookcat(){
    try{
      $sql = "SELECT * FROM bookcat";
      $stmt = $this -> conn -> prepare($sql);
      $stmt->execute();
      $arr = array();
      $book_list=$stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($book_list as $row){
        $arr[] = $row;
      }
      header('Content-Type:application/json');
      echo json_encode($arr);

    }catch(PDOException  $e){
      echo 'PDOException: ' . $e->getMessage();
    }
  }
  //add book category
  public function addcat($BookCatName){
    try{
      $sql = "INSERT INTO bookcat(BookCatName)
      VALUES (:b)";
      $stmt = $this -> conn -> prepare($sql);
      $stmt -> bindValue(':b', $BookCatName);
      $stmt->execute();
      header('Content-Type:application/json');
      echo json_encode("book category created");
    }catch(PDOException  $e){
      throw new Exception($e->getMessage());
    }
  }
  //display user information(staff)
  

}
?>
