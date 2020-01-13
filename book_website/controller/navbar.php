<div id="header">
  <h1>WELCOME TO BOOK ADVENTURE!</h1>
</div>
<div id="user_navbar">
  <?php
  $username  = $_SESSION["userName"];
  echo "User Name: ". $_SESSION["userName"];
  echo" Role :"    .$_SESSION["role"];
  if(!empty($_GET['message']))
  {
    $bt=$_GET['message'];
    //   diaply on main page message for delete book
    echo"<div style='float:left;'> Book Title : <strong>".$bt. "</strong> is deleted on : ". date("d/m/Y") ." by User: <strong>". $username."</strong></div>";
  }
  if(!empty($_GET['message1']))
  {
    $bt2=$_GET['message1'];
    //   diaply on main page message for update book
    echo"<div style='float:left;'> Book Title : <strong>".$bt2. "</strong> is updated  on : ". date("d/m/Y") ." by User: <strong>". $username."</strong></div>";
  }
  ?>
</div>
<div id="nav">
  <ul type="none">
    <li><a href="?link=DisplayBook" name="DisplayBook">Display Books</a></li>
    <?php
    if(isset($_SESSION['role']))
    {
      if($_SESSION['role']=='admin')
      {
        echo"<li><a href='?link=AddNewBookAndAuthor' name='AddNewBookAndAuthor'>Add New Books</a></li>";
        //diplay link for manager  newAdminUser so can creat new admin user
      }
      if($_SESSION['role']=='manager')
      {
        echo"<li><a href='?link=AddNewBookAndAuthor' name='AddNewBookAndAuthor'>Add New Books</a></li>";
        echo"<li><a href='?link=RegistrationForm' name='RegistrationForm'>Add New Users</a></li> ";
      }
    }
    ?>
    <li><a href="?link=changelog" name="changelog">Changelog</a></li>
    <li><a href="../../logout.php" name="logout">Logout</a></li>

  </ul>
</div>
