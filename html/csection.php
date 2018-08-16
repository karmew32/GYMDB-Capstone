<!--
This file is used to display the records from database
Copy this file in /var/www/html and open run http://localhost/editrecord.php
-->
<?php
$secno = $_GET[secno];// get the id value from url parameters

$servername = "localhost";// sql server name
$username = "root";// sql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($_GET["mode"] == "delete"){

$sqldelete = "DELETE FROM csection WHERE sectionNo='$secno'";//delete statement
$delete = $conn->query($sqldelete);//execute the query
if($delete)
 { 
  echo "Record deleted successfully!";
 }
}

$sql = "SELECT * FROM csection";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Section #</th>
	    <th style='border: solid 1px black;'>Teacher ID</th>
	    <th style='border: solid 1px black;'>Class ID</th>
	    <th style='border: solid 1px black;'>Class Time</th>
            <th style='border: solid 1px black;'>Delete</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['sectionNo'].'</td>
		<td style="border: solid 1px black;">'.$row['emp_ID'].'</td>
		<td style="border: solid 1px black;">'.$row['classID'].'</td>
		<td style="border: solid 1px black;">'.$row['classTime'].'</td>

<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and including the parameter sno to be used it in the destination page (edit.php)-->
		<td> <a href="csection.php?secno='.$row['sectionNo'].'&mode=delete">Delete </a></td>
	      </tr>';
}
 echo "</table>";


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
To add a class section, enter its information below:
<br/> <br/>
<!-- Below, we define components exist in the page (textboxes and submit button) -->
Section # : <input type ="text" name ="secno_tb"/>
<br/> <br/>
<?php
$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
$username = "root";// mysql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlA = "SELECT emp_ID FROM teacher";// select statement
$selA = $conn->query($sqlA);// get result
$sqlB = "SELECT classID FROM class";// select statement
$selB = $conn->query($sqlB);// get result
echo 'Teacher ID: <select name="empid_dd">';
while ($row = $selA -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['emp_ID'].'">'.$row['emp_ID'].'</option>';
}
echo '</select> <br/> <br/>';
echo 'Class ID: <select name="classid_dd">';
while ($row = $selB -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['classID'].'">'.$row['classID'].'</option>';
}
echo '</select> <br/> <br/>' ;
if(isset($_POST['insert'])){ //things to do, once the "submit" key is hit
        $secno=$_POST[secno_tb];
	$empid=$_POST[empid_dd];//get form value name attribute
	$classid = $_POST[classid_dd];//get form values state attribute
	$time = $_POST[time_tb];//get form values sno attribute

	// Create connection
	$sql = "INSERT INTO csection VALUES ('$secno','$empid', '$classid', '$time')";//embed insert statement in PHP
	$result = $conn->query($sql);

	if($result) //if the insert into database was successful
	{
	$output = "Records inserted successfully";
	}
        else{
        $output = "Failure or no attempt";
        }
}

?>
Time : <input type ="text" name ="time_tb"/>
<br/> <br/>
<input type ="submit" value="Insert" name="insert"/>
<br/> <br/><a href="gym.html">Back</a><br/>
<p name="state"><?php echo $output ?></p>
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
