<!--
This file is used to edit the records in table S. You do not need to run this by yourself. 
This is called by the editrecord.php.
-->
<?php
$secno = $_GET[secno]; //the value of sno is received from the editrecord.php page

$servername = "localhost";
$username = "root";
$password = "student";
$dbname  = "GYMDB";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

//Things to do, after the "update_btn" button is clicked.
if(isset($_POST[update_btn]))
{
	$sql_update= "UPDATE csection SET vis_fname='$_POST[fname_tb]', vis_lname='$_POST[lname_tb]', trn_ID='$_POST[trnid_dd]' WHERE sectionNo='$secno'";

	$resultupdate = $conn->query($sql_update);

	if($resultupdate) //if the update is done successfully
		{
		echo "Records updated successfully";
		}
}

//when the page is loaded (also after the update is effective), the information of the selected (updated) record is loaded
$sql = "SELECT * FROM visitor WHERE ULID='$ulid'";
$result = $conn->query($sql);
?>

<form action="" method="post">
<?php
if($result->num_rows > 0){//if the record is found (which is expected!), then display it in a table
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>ULID</th>
	    <th>First Name</th>
	    <th>Last Name</th>
            <th>Trainer ID</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){//fetch the attributes to put in the designated textboxes
	echo '<tr>
		<!-- just for simplicity, we assume the PK value cannot be updated, as such, it is "readonly" -->
		<td><input type="text" name="empid_tb" value="'.$row['ULID'].'" readonly/></td>
		<td><input type="text" name="fname_tb" value="'.$row['vis_fname'].'"/></td>
		<td><input type="text" name="lname_tb" value="'.$row['vis_lname'].'"/></td>
                <td><select name="trnid_dd">
                <option selected hidden value="'.$row['trn_ID'].'">'.$row['trn_ID'].'</option>';
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

   		echo ' </select> </td>
	      <tr>';
}
 echo "</table>";

?>
<input type="submit" value="Update" name="update_btn"/>
<br/> <br/><a href="csection.php">Back</a><br/>
</form>

