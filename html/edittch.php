<!--
This file is used to edit the records in table S. You do not need to run this by yourself. 
This is called by the editrecord.php.
-->
<?php
$empid = $_GET[empid]; //the value of sno is received from the editrecord.php page

$servername = "localhost";
$username = "root";
$password = "student";
$dbname  = "GYMDB";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

//Things to do, after the "update_btn" button is clicked.
if(isset($_POST[update_btn]))
{
	$sql_update= "UPDATE teacher SET emp_fname='$_POST[fname_tb]', emp_lname='$_POST[lname_tb]', salary='$_POST[salary_tb]' WHERE emp_ID='$empid'";

	$resultupdate = $conn->query($sql_update);

	if($resultupdate) //if the update is done successfully
		{
		echo "Records updated successfully";
		}
}

//when the page is loaded (also after the update is effective), the information of the selected (updated) record is loaded
$sql = "SELECT * FROM teacher WHERE emp_ID='$empid'";
$result = $conn->query($sql);
?>

<form action="" method="post">
<?php
if($result->num_rows > 0){//if the record is found (which is expected!), then display it in a table
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>Employee ID</th>
	    <th>First Name</th>
	    <th>Last Name</th>
            <th>Section</th>
	    <th>Salary</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){//fetch the attributes to put in the designated textboxes
	echo '<tr>
		<!-- just for simplicity, we assume the PK value cannot be updated, as such, it is "readonly" -->
		<td><input type="text" name="empid_tb" value="'.$row['emp_ID'].'" readonly/></td>
		<td><input type="text" name="fname_tb" value="'.$row['emp_fname'].'"/></td>
		<td><input type="text" name="lname_tb" value="'.$row['emp_lname'].'"/></td>
                <td><input type="text" name="salary_tb" value="'.$row['salary'].'"/></td>
	      <tr>';
}
 echo "</table>";

?>
<input type="submit" value="Update" name="update_btn"/>
<br/> <br/><a href="teacher.php">Back</a><br/>
</form>

