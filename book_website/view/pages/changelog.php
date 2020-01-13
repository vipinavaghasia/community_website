<?php
//execute select statement and diplay chagelog detail
$result = $db->prepare("SELECT c.changeLogID,c.dateCreated,c.dateChanged,c.BookID,c.userID,login.userName FROM changelog c INNER JOIN users ON users.userID=c.userID INNER JOIN login on login.loginID=users.loginID  ");
$result->execute();
echo "<table border= '1' style='font-size:16px;'>
<caption>Changelog information</caption>
<thead>
<tr>
<th colspan=6>Changelog information</th>
</tr>
<tr>
<th>ChangelogId</th>
<th>Created date</th>
<th>Updated date</th>
<th>BookID</th>
<th>Userid</th>
<th>User Name</th>
</tr> </thead>
<tbody>";
for($i=0; $row = $result->fetch(); $i++){
  echo "<tr>";
  echo "<td>" . $row['changeLogID'] . "</td>";
  echo "<td>" . $row['dateCreated'] . "</td>";
  echo "<td>" . $row['dateChanged'] . "</td>";
  echo "<td>" . $row['BookID'] . "</td>";
  echo "<td>" . $row['userID'] . "</td>";
  echo "<td>" . $row['userName'] . "</td>";
  echo "</tr>";
}
echo "</tbody></table>";
?>
