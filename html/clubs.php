<!--
This file is used to display the records from database
Copy this file in /var/www/html and open run http://localhost/editrecord.php
-->
<?php
$clubno = $_GET[clubno];// get the id value from url parameters

$servername = "localhost";// sql server name
$username = "root";// sql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($_GET["mode"] == "delete"){

$sqldelete = "DELETE FROM clubs WHERE clubNo='$clubno'";//delete statement
$delete = $conn->query($sqldelete);//execute the query
if($delete)
 { 
  echo "Record deleted successfully!";
 }
}

$sql = "SELECT * FROM clubs";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Club #</th>
	    <th style='border: solid 1px black;'>Club Name</th>
	    <th style='border: solid 1px black;'>Gym Subsection</th>
	    <th style='border: solid 1px black;'>Practice Time</th>
	    <th style='border: solid 1px black;'>Edit</th>
            <th style='border: solid 1px black;'>Delete</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['clubNo'].'</td>
		<td style="border: solid 1px black;">'.$row['club_name'].'</td>
		<td style="border: solid 1px black;">'.$row['SSName'].'</td>
		<td style="border: solid 1px black;">'.$row['practiceTime'].'</td>

<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and including the parameter sno to be used it in the destination page (edit.php)-->
		<td style="border: solid 1px black;"> <a href="editclubs.php?clubno='.$row['clubNo'].'">Click </a></td>
		<td> <a href="clubs.php?clubno='.$row['clubNo'].'&mode=delete">Delete </a></td>
	      </tr>';
}
 echo "</table>";

if(isset($_POST['insert'])){ //things to do, once the "submit" key is hit

	$no=$_POST[no_tb];//get form value name attribute
	$name = $_POST[name_tb];//get form values state attribute
	$section = $_POST[section_dd];//get form values state attribute
	$ptime = $_POST[ptime_tb];//get form values sno attribute

	$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
	$username = "root";// mysql username
	$password = "student";// sql password
	$dbname  = "GYMDB";// database name

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "INSERT INTO clubs VALUES ('$no', '$name','$section','$ptime')";//embed insert statement in PHP
	$result = $conn->query($sql);

	if($result) //if the insert into database was successful
	{
	echo "Records inserted successfully";
	}
        else{
        echo "Failure";
        }
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">




<!-- You can uncomment this part just for a better placement of the success message --> 
<!-- <?php
if($result)
	{
	echo "Records inserted successfully";
	}
?> -->


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<br/>	<!-- The <br> tag inserts a single line break.-->
To add a club, enter its information below:
<br/> <br/>
<!-- Below, we define components exist in the page (textboxes and submit button) -->
Club Number : <input type="text" name="no_tb"/> 
<br/> <br/>
Club Name : <input type="text" name="name_tb"/>
<br/> <br/>
Section :  <select name="section_dd">
  <option value="Racquetball Court">Racquetball Court</option>
  <option value="Basketball Court">Basketball Court</option>
  <option value="Martial Arts Room">Martial Arts Room</option>
  <option value="Weightlifting Room">Weightlifting Room</option>
  <option value="Tennis Court">Tennis Court</option>
  <option value="Swimming Pool">Swimming Pool</option>
</select> 
<br/> <br/>
Practice Time : <input type ="text" name ="ptime_tb"/>
<br/> <br/>
<input type ="submit" value="Insert" name="insert"/>
<br/> <br/><a href="gym.html">Back</a><br/>
<!-- You can uncomment this part just for a better placement of the success message --> 
<!-- <?php
if($result)
	{
	echo "Records inserted successfully";
	}
?> -->

</form>
</body>
</html>
