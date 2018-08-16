<!--
This file is used to edit the records in table S. You do not need to run this by yourself. 
This is called by the editrecord.php.
-->
<?php
$ulid = $_GET[ulid]; //the value of sno is received from the editrecord.php page

$servername = "localhost";
$username = "root";
$password = "student";
$dbname  = "GYMDB";

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

//Things to do, after the "update_btn" button is clicked.

//when the page is loaded (also after the update is effective), the information of the selected (updated) record is loaded
$sql = "SELECT * FROM clubmem WHERE ULID='$ulid'";
$result = $conn->query($sql);
?>

<form action="" method="post">
<?php
if($result->num_rows > 0){//if the record is found (which is expected!), then display it in a table
 echo "<table style='border: solid 1px black;'>
	<tr>
	    <th>ULID</th>
	    <th>Club #</th>
	</tr>";
}

while ($row = $result -> fetch_assoc()){//fetch the attributes to put in the designated textboxes
echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">'.$row['ULID'].'</td>
		<td style="border: solid 1px black;">'.$row['clubNo'].'</td>

<!-- the core edit operation is done in edit.php. Here, we create only a hyperlink and send parameters to edit.php -->		
<!--For each row of the table, we create a hyperlink and including the parameter sno to be used it in the destination page (edit.php)-->
	      </tr>';
}
 echo "</table>";

?>
<br/> <br/><a href="clubmem.php">Back</a><br/>
</form>

