<!--
This file is used to display the records from database
Copy this file in /var/www/html and open run http://localhost/editrecord.php
-->
<?php

$servername = "localhost";// sql server name
$username = "root";// sql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM scanin";// embed a select statement in php
$result = $conn->query($sql);// get result

if($result->num_rows > 0){// check for number of rows. If there are records, build a table to show them
 echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Deskworker ID</th>
	    <th style='border: solid 1px black;'>Visitor ULID</th>
	    <th style='border: solid 1px black;'>Time (Military)</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['emp_ID'].'</td>
		<td style="border: solid 1px black;">'.$row['ULID'].'</td>
		<td style="border: solid 1px black;">'.$row['time'].'</td>
	      </tr>';
}
 echo "</table>";

if(isset($_POST['insert'])){ //things to do, once the "submit" key is hit

	$empid=$_POST[empid_dd];//get form value name attribute
	$ulid = $_POST[ulid_dd];//get form values state attribute
	$time = $_POST[time_tb];//get form values sno attribute

	// Create connection
	$sql = "INSERT INTO scanin VALUES ('$empid', '$ulid', '$time')";//embed insert statement in PHP
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

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">




<!-- You can uncomment this part just for a better placement of the success message --> 
<!-- <?php
if($result)
	{
	echo "Records inserted successfully";
	}
?> -->


<br/>	<!-- The <br> tag inserts a single line break.-->
To record a scan-in, select the information below:
<br/> <br/>
<!-- Below, we define components exist in the page (textboxes and submit button) -->

<?php
$servername = "localhost";// sql server machine name/IP (if your computer is the server too, then just keep it as "localhost"). 
$username = "root";// mysql username
$password = "student";// sql password
$dbname  = "GYMDB";// database name
$conn = new mysqli($servername, $username, $password, $dbname);
$sqlA = "SELECT emp_ID FROM deskworker";// select statement
$selA = $conn->query($sqlA);// get result
$sqlB = "SELECT ULID FROM visitor";// select statement
$selB = $conn->query($sqlB);// get result
echo 'Deskworker ID: <select name="empid_dd">';
while ($row = $selA -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['emp_ID'].'">'.$row['emp_ID'].'</option>';
}
echo '</select> <input type ="submit" value="Filter by Deskworker ID" name="filter_empid"/> <br/> <br/>';
echo 'Visitor ULID: <select name="ulid_dd">';
while ($row = $selB -> fetch_assoc()){// store the result in an array
	echo '<option value="'.$row['ULID'].'">'.$row['ULID'].'</option>';
}
echo '</select> <input type ="submit" value="Filter by ULID" name="filter_ulid"/> <br/> <br/>';

if(isset($_POST['filter_ulid'])){ //things to do, once the "submit" key is hit

	$ulid = $_POST[ulid_dd];//get form values state attribute
        echo '<a href="ulidscin.php?ulid='.$ulid.'">View info filtered by ULID </a> <br/>';
	
}

if(isset($_POST['filter_empid'])){ //things to do, once the "submit" key is hit

	$empid = $_POST[empid_dd];//get form values state attribute
        echo '<a href="empidscin.php?empid='.$empid.'">View info filtered by Deskworker ID </a> <br/>';
	
}
?>
Time : <input type ="text" name ="time_tb"/>
<br/> <br/>
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
