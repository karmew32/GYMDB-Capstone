<!--
This file is used to display the records from database
Copy this file in /var/www/html and open run http://localhost/editrecord.php
-->
<?php
$classid = $_GET[classid];// get the id value from url parameters

$servername = "localhost";// sql server name
$username = "root";// sql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($_GET["mode"] == "delete"){

$sqldelete = "DELETE FROM class WHERE classID='$classid'";//delete statement
$delete = $conn->query($sqldelete);//execute the query
if($delete)
 { 
  echo "Record deleted successfully!";
 }
}

$sql = "SELECT * FROM class";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Class ID</th>
	    <th style='border: solid 1px black;'>Class Name</th>
            <th style='border: solid 1px black;'>Delete</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['classID'].'</td>
		<td style="border: solid 1px black;">'.$row['className'].'</td>

<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and including the parameter sno to be used it in the destination page (edit.php)-->
		<td> <a href="class.php?classid='.$row['classID'].'&mode=delete">Delete </a></td>
	      </tr>';
}
 echo "</table>";

if(isset($_POST['insert'])){ //things to do, once the "submit" key is hit

	$id=$_POST[id_tb];//get form value name attribute
	$name = $_POST[name_tb];//get form values state attribute

	$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
	$username = "root";// mysql username
	$password = "student";// sql password
	$dbname  = "GYMDB";// database name

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "INSERT INTO class VALUES ('$id', '$name')";//embed insert statement in PHP
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

<br/>	<!-- The <br> tag inserts a single line break.-->
To add a class, enter its information below:
<br/> <br/>
<!-- Below, we define components exist in the page (textboxes and submit button) -->
Class ID : <input type="text" name="id_tb"/> 
<br/> <br/>
Class Name : <input type="text" name="name_tb"/>
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
