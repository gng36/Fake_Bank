<?php
	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	//$finQuery = query("select username from user;");
	//$res = $con->query($finQuery);
	$res = $mysqli->query("SELECT username FROM user");
$row = $res->fetch_assoc();

//printf($row['username']));
//printf($row['username'], gettype($row['username']));
//printf("label = %s (%s)\n", $row['username'], gettype($row['username']));
echo $row['username'];

//echo $row;

//echo "red";


//echo $res;



?>
