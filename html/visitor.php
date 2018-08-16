<!--
This file is used to display the records from database
Copy this file in /var/www/html and open run http://localhost/editrecord.php
-->
<?php
$ulid = $_GET[ulid];// get the id value from url parameters

$servername = "localhost";// sql server name
$username = "root";// sql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($_GET["mode"] == "delete"){

$sqldelete = "DELETE FROM visitor WHERE ULID='$ulid'";//delete statement
$delete = $conn->query($sqldelete);//execute the query
if($delete)
 { 
  echo "Record deleted successfully!";
 }
}

$sql = "SELECT * FROM visitor";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>ULID</th>
	    <th style='border: solid 1px black;'>First Name</th>
	    <th style='border: solid 1px black;'>Last Name</th>
	    <th style='border: solid 1px black;'>Trainer ID</th>
	    <th style='border: solid 1px black;'>Edit</th>
            <th style='border: solid 1px black;'>Delete</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['ULID'].'</td>
		<td style="border: solid 1px black;">'.$row['vis_fname'].'</td>
		<td style="border: solid 1px black;">'.$row['vis_lname'].'</td>
		<td style="border: solid 1px black;">'.$row['trn_ID'].'</td>

<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and including the parameter sno to be used it in the destination page (edit.php)-->
		<td style="border: solid 1px black;"> <a href="editvis.php?ulid='.$row['ULID'].'">Click </a></td>
		<td> <a href="visitor.php?ulid='.$row['ULID'].'&mode=delete">Delete </a></td>
	      </tr>';
}
 echo "</table>";

if(isset($_POST['insert'])){ //things to do, once the "submit" key is hit

	$ulid=$_POST[ulid_tb];//get form value name attribute
	$fname = $_POST[fname_tb];//get form values state attribute
	$lname = $_POST[lname_tb];//get form values sno attribute
	$trnid = $_POST[trnid_dd];//get form values state attribute

	// Create connection
	$sql = "INSERT INTO visitor VALUES ('$ulid', '$fname', '$lname', '$trnid')";//embed insert statement in PHP
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


<br/>	<!-- The <br> tag inserts a single line break.-->
To add a visitor, enter their information below:
<br/> <br/>
<!-- Below, we define components exist in the page (textboxes and submit button) -->
ULID : <input type="text" name="ulid_tb"/> 
<br/> <br/>
First Name : <input type="text" name="fname_tb"/>
<br/> <br/>
Last Name : <input type ="text" name ="lname_tb"/>
<br/> <br/>
Trainer ID : <select name="trnid_dd">
<?php
$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
$username = "root";// mysql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlselect = "SELECT emp_ID FROM trainer";// select statement
$selresult = $conn->query($sqlselect);// get result

while ($row = $selresult -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['emp_ID'].'">'.$row['emp_ID'].'</option>';
}
echo '</select>';

?>

<input type ="submit" value="Insert" name="insert"/>
<br/> <br/><a href="gym.html">Back</a><br/>
<!-- The following piece of code is run when the page is loaded (before submit button is hit) -->
<!-- "form" is an HTML tag that enable us to have components such as textbox and buttons in the html page.
"action" part determines the page where the information of the current form (page) should be sent.
"method" part determines if the data in the current form is sent/received to/from another page.
The value of "method" is generally "post". -->
<!--
Here we use $_SERVER['PHP_SELF'] which returns the current page. Here it return insert.php
-->
</form>
</body>
</html>
