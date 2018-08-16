<!--
This file is used to edit the records in table S. You do not need to run this by yourself. 
This is called by the editrecord.php.
-->
<?php
$clubno = $_GET[clubno]; //the value of sno is received from the editrecord.php page

$servername = "localhost";
$username = "root";
$password = "student";
$dbname  = "GYMDB";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

//Things to do, after the "update_btn" button is clicked.
if(isset($_POST[update_btn]))
{
	$sql_update= "UPDATE clubs SET club_name='$_POST[name_tb]', SSName='$_POST[section_dd]', practiceTime='$_POST[ptime_tb]' WHERE clubNo='$clubno'";

	$resultupdate = $conn->query($sql_update);

	if($resultupdate) //if the update is done successfully
		{
		echo "Records updated successfully";
		}
}

//when the page is loaded (also after the update is effective), the information of the selected (updated) record is loaded
$sql = "SELECT * FROM clubs WHERE clubNo='$clubno'";
$result = $conn->query($sql);
?>

<form action="" method="post">
<?php
if($result->num_rows > 0){//if the record is found (which is expected!), then display it in a table
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>Club #</th>
	    <th>Club Name</th>
            <th>Section</th>
	    <th>Practice Time</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){//fetch the attributes to put in the designated textboxes
	echo '<tr>
		<!-- just for simplicity, we assume the PK value cannot be updated, as such, it is "readonly" -->
		<td><input type="text" name="no_tb" value="'.$row['clubNo'].'" readonly/></td>
		<td><input type="text" name="name_tb" value="'.$row['club_name'].'"/></td>
                <td><select name="section_dd">
                        <option selected hidden value="'.$row['SSName'].'">'.$row['SSName'].'</option>
  			<option value="Racquetball Court">Racquetball Court</option>
			<option value="Basketball Court">Basketball Court</option>
			<option value="Martial Arts Room">Martial Arts Room</option>
			<option value="Weightlifting Room">Weightlifting Room</option>
			<option value="Tennis Court">Tennis Court</option>
			<option value="Swimming Pool">Swimming Pool</option>
                </select> </td>
                <td><input type="text" name="ptime_tb" value="'.$row['practiceTime'].'"/></td>
	      <tr>';
}
 echo "</table>";

?>
<input type="submit" value="Update" name="update_btn"/>
<br/> <br/><a href="clubs.php">Back</a><br/>
</form>

