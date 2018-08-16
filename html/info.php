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

$sqlfd = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Front Desk')";//delete statement
$frontdesk = $conn->query($sqlfd);//execute the query



while ($row = $frontdesk -> fetch_assoc()){// Fetch the query result and store them in an array
	echo '# of people who entered gym: '.$row['count'].'</br></br></br></br>';
}


echo "<table style='border: solid 1px black;'>
	<tr style='border: solid 1px black;'>
	    <th style='border: solid 1px black;'>Subsection</th>
	    <th style='border: solid 1px black;'># of People</th>
	</tr>";


$sqlcr = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Classrooms')";//delete statement
$classrooms = $conn->query($sqlcr);//execute the query

while ($row = $classrooms -> fetch_assoc()){// Fetch the query result and store them in an array

  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Classrooms</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqlrb = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Racquetball Court')";//delete statement
$racquetball = $conn->query($sqlrb);//execute the query


while ($row = $racquetball -> fetch_assoc()){// Fetch the query result and store them in an array
	  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Racquetball Court</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqlbb = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Basketball Court')";//delete statement
$basketball = $conn->query($sqlbb);//execute the query


while ($row = $basketball -> fetch_assoc()){// Fetch the query result and store them in an array
	  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Basketball Court</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqlma = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Martial Arts Room')";//delete statement
$martialarts = $conn->query($sqlma);//execute the query


while ($row = $martialarts -> fetch_assoc()){// Fetch the query result and store them in an array
	  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Martial Arts Room</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqlwl = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Weightlifting Room')";//delete statement
$weightlifting = $conn->query($sqlwl);//execute the query


while ($row = $weightlifting -> fetch_assoc()){// Fetch the query result and store them in an array
	  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Weightlifting Room</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqltc = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Tennis Court')";//delete statement
$tennis = $conn->query($sqltc);//execute the query


while ($row = $tennis -> fetch_assoc()){// Fetch the query result and store them in an array
	  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Tennis Court</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

$sqlsp = "SELECT COUNT(emp_ID) AS count FROM scanin WHERE emp_ID IN (SELECT emp_ID FROM deskworker WHERE emp_section='Swimming Pool')";//delete statement
$swimming = $conn->query($sqlsp);//execute the query


while ($row = $swimming -> fetch_assoc()){// Fetch the query result and store them in an array
	  echo '<tr style="border: solid 1px black;">
		<td style="border: solid 1px black;">Swimming Pool</td>
		<td style="border: solid 1px black;">'.$row['count'].'</td>
	      </tr>';
}

echo "</table>";
?>

<br/> <br/><a href="gym.html">Back</a><br/>
</body>
</html>
