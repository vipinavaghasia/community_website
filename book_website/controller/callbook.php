<?php
//select data from Author and book table and display
$result = $db->prepare("SELECT book.BookID,book.AuthorID,book.BookTitle,book.coverImagePath, book.YearofPublication,author.Name,book.MillionsSold FROM book INNER JOIN author on book.AuthorID=author.AuthorID ORDER by book.AuthorID ");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
  $author=$row['AuthorID'];
  $book=$row['BookID'];
  echo"
  <div class='grid-container'>

  <p><img src=".$row['coverImagePath']." alt='coverImagePath'width='120' height='150' class='rotate'</p>
  <p>Author Name:".$row['Name']."</P>
  <p>Year of Publication:".$row['YearofPublication']."</P>
  <p> BookTitle:".$row['BookTitle']."</P>
  <p>copied sold:".$row['MillionsSold']."</P>
  <p><a href='UpdateAndDeleteForm.php?bid=$book&aid=$author'>Update</a></p>
  <p><a href='UpdateAndDeleteForm.php?bid=$book&aid=$author'>Delete</a></p>
  </div>";
}
?>
