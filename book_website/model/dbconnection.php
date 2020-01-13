<?php
$dbusername='root';
$dbpassword='';
try{
  $db=new PDO("mysql:host=localhost;dbname=book",$dbusername,$dbpassword);
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);

}
catch(PDOException $e)
{
  $error_massage=$e->getMessage();
  ?>
  <h1>Database connection Error</h1>
  <p> There was an error connection to the database.</p>
  <P>Error message:<?php echo $error_message;?></P>
  <?php
  die();
}
?>
