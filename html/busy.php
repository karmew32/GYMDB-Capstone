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



echo 'Business of the gym by time of day: </br></br>';


echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Part of Day</th>
	    <th style='border: solid 1px black;'># of People</th>
	</tr>";


$sqlmorn = "SELECT COUNT(*) AS count FROM scanin WHERE time < 1200";//delete statement
$morning = $conn->query($sqlmorn);//execute the query

while ($row = $morning -> fetch_assoc()){// Fetch the query result and store them in an array

  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Morning</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqlafter = "SELECT COUNT(*) AS count FROM scanin WHERE time >= 1200 AND time < 1600";//delete statement
$afternoon = $conn->query($sqlafter);//execute the query

while ($row = $afternoon -> fetch_assoc()){// Fetch the query result and store them in an array

  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Afternoon</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqleve = "SELECT COUNT(*) AS count FROM scanin WHERE time >= 1600";//delete statement
$evening = $conn->query($sqleve);//execute the query

while ($row = $evening -> fetch_assoc()){// Fetch the query result and store them in an array

  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Evening</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}



echo "</table>";
?>

<br/> <br/><a href="gym.html">Back</a><br/>
</body>
</html>
