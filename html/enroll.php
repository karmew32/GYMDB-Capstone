<!--
This file is used to display the records from database
Copy this file in /var/www/html and open run http://localhost/editrecord.php
-->
<?php

$ulid = $_GET[ulid];// get the id value from url parameters
$secno = $_GET[secno];// get the id value from url parameters

$servername = "localhost";// sql server name
$username = "root";// sql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($_GET["mode"] == "delete"){

$sqldelete = "DELETE FROM enroll WHERE ULID='$ulid' AND sectionNo='$secno'";//delete statement
$delete = $conn->query($sqldelete);//execute the query
if($delete)
 { 
  echo "Record deleted successfully!";
 }
}

$sql = "SELECT * FROM enroll";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Student ULID</th>
	    <th style='border: solid 1px black;'>Section #</th>
            <th style='border: solid 1px black;'>Delete</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['ULID'].'</td>
		<td style="border: solid 1px black;">'.$row['sectionNo'].'</td>

<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and including the parameter sno to be used it in the destination page (edit.php)-->
		<td> <a href="enroll.php?ulid='.$row['ULID'].'&secno='.$row['sectionNo'].'&mode=delete">Delete </a></td>
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
To enroll a student in a class section, select the information below:
<br/> <br/>
<!-- Below, we define components exist in the page (textboxes and submit button) -->

<?php
$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
$username = "root";// mysql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlA = "SELECT ULID FROM visitor";// select statement
$selA = $conn->query($sqlA);// get result
$sqlC = "SELECT sectionNo FROM csection";// select statement
$selC = $conn->query($sqlC);// get result
echo 'Visitor ULID: <select name="ulid_dd">';
while ($row = $selA -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['ULID'].'">'.$row['ULID'].'</option>';
}
echo '</select> <input type ="submit" value="Filter by ULID" name="filter_ulid"/> <br/> <br/>';
echo 'Section Number: <select name="secno_dd">';
while ($row = $selC -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['sectionNo'].'">'.$row['sectionNo'].'</option>';
}
echo '</select> <input type ="submit" value="Filter by Section #" name="filter_secno"/> <br/> <br/>';
if(isset($_POST['insert'])){ //things to do, once the "submit" key is hit

	$ulid = $_POST[ulid_dd];//get form values state attribute
	$secno = $_POST[secno_dd];//get form values sno attribute

	// Create connection
	$sql = "INSERT INTO enroll VALUES ('$ulid', '$secno')";//embed insert statement in PHP
	$result = $conn->query($sql);

	if($result) //if the insert into database was successful
	{
	$output = "Records inserted successfully";
	}
        else{
        $output = "Failure or no attempt";
        }
}

if(isset($_POST['filter_ulid'])){ //things to do, once the "submit" key is hit

	$ulid = $_POST[ulid_dd];//get form values state attribute
        echo '<a href="ulidenr.php?ulid='.$ulid.'">View info filtered by ULID </a> <br/>';
	
}

if(isset($_POST['filter_secno'])){ //things to do, once the "submit" key is hit

	$secno = $_POST[secno_dd];//get form values state attribute
        echo '<a href="secnoenr.php?secno='.$secno.'">View info filtered by Section # </a> <br/>';
        
	
}

?>
<input type ="submit" value="Insert" name="insert"/>
<p name="state"><?php echo $output ?></p>
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
