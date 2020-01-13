<?php
//insert statement for book table
function addBook($BookTitle,$OriginalTitle,$YearofPublication,$Genre,$MillionsSold,
$LanguageWritten,$Author,$coverImagePath)
{
  global $db;
  try{
    $sql="INSERT INTO book (BookTitle,OriginalTitle,YearofPublication,Genre,MillionsSold,
      LanguageWritten,AuthorID,coverImagePath)
      VALUES(?,?,?,?,?,?,?,?)";
      $stmt=$db->prepare($sql);
      $stmt->execute([$BookTitle,$OriginalTitle,$YearofPublication,$Genre,$MillionsSold,$LanguageWritten,$Author,$coverImagePath]);
    }
    catch(PDOException $ex)
    {
      throw $ex;
    }
  }
  function newAdminUser($userName,$password,$role,$firstName,
  $lastName,$email)
  {
    global $db;
    try{
      //begin the transaction
      $db->beginTransaction();
      //insert statement for login table
      $query=$db->prepare("INSERT INTO login(userName,password,role) VALUES (:userName,:password,:role)");
      $query->bindvalue(':userName',$userName);
      $query->bindvalue(':password',$password);
      $query->bindvalue(':role',$role);
      $query->execute();
      //insert statement for users table
      $id=$db->lastInsertId();
      $query=$db->prepare("INSERT INTO users (firstName,lastName,email,loginID) VALUES (:firstName,:lastName,:email,:loginID)");
      $query->bindvalue(':firstName',$firstName);
      $query->bindvalue(':lastName',$lastName);
      $query->bindvalue(':email',$email);
      $query->bindvalue(':loginID',$id);
      $query->execute();
      // commit the transaction
      $db->commit();
    }
    catch(PDOException $ex){
      //roll back the transaction if something failed
      $db->rollback();
      throw $ex;
    }
  }
  function addAuthorAndBook($Name,$Surname, $Nationality,$BirthYear,$DeathYear,$BookTitle,$OriginalTitle,$YearofPublication,$Genre,$MillionsSold,
  $LanguageWritten,$coverImagePath,$userID)
  {
    global $db;
    try{
      //begin the transaction
      $db->beginTransaction();
      //insert statement for Author table
      $query=$db->prepare("INSERT INTO author (Name,Surname, Nationality,BirthYear,DeathYear) VALUES (:Name, :Surname, :Nationality, :BirthYear, :DeathYear)");
      $query->bindvalue(':Name',$Name);
      $query->bindvalue(':Surname',$Surname);
      $query->bindvalue(':Nationality',$Nationality);
      $query->bindvalue(':BirthYear',$BirthYear);
      $query->bindvalue(':DeathYear',$DeathYear);
      $query->execute();
      //insert statement for book table
      $authorid=$db->lastInsertId();
      $query=$db->prepare("INSERT INTO book (BookTitle,OriginalTitle,YearofPublication,Genre,MillionsSold,LanguageWritten,AuthorID,coverImagePath)
      VALUES(:BookTitle,:OriginalTitle,:YearofPublication,:Genre,:MillionsSold,:LanguageWritten,
        :AuthorID,:coverImagePath)");
        $query->bindvalue(':BookTitle',$BookTitle);
        $query->bindvalue(':OriginalTitle',$OriginalTitle);
        $query->bindvalue(':YearofPublication',$YearofPublication);
        $query->bindvalue(':Genre',$Genre);
        $query->bindvalue(':MillionsSold',$MillionsSold);
        $query->bindvalue(':LanguageWritten',$LanguageWritten);
        $query->bindvalue(':AuthorID',$authorid);
        $query->bindvalue(':coverImagePath',$coverImagePath);
        $query->execute();

        $BookID = $db->lastInsertId();
        $mylogin= $_SESSION['loginID'];
        //selecting data from users table
        $query=$db->prepare("SELECT * FROM users where userID=$mylogin");
        //  $query=$db->prepare("SELECT * FROM users where userID='$userID'");
        $query->execute();
        $rows=$query->fetch();
        $userID=$rows['userID'];
        date_default_timezone_set('Australia/Brisbane');
        $date = date('Y-m-d H:i:s');
        //insert statement for changelog table
        $query = $db -> prepare("INSERT INTO changelog(dateCreated, dateChanged, BookID, userID)
        VALUES(:dc, :dh, :bid, :un)");
        $query -> bindvalue(':dc', $date);
        $query -> bindvalue(':dh', $date);
        $query -> bindvalue(':bid', $BookID);
        $query-> bindvalue(':un', $userID);
        $query->execute();
        // commit the transaction
        $db->commit();
      }
      catch(PDOException $ex){
        //roll back the transaction if something failed
        $db->rollback();
        throw $ex;
      }
    }

    ?>
