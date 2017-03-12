
<?php
session_start();

//echo $_SESSION['user'];

	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");

	//$username= 'user12';
$username = $_SESSION['user'];

//echo $username;


	
	$res = $mysqli->query("SELECT balance FROM account WHERE username = '$username' and type ='Checkings'");
	$row = $res->fetch_assoc();
	//echo $row['balance'];

	$res2 = $mysqli->query("SELECT balance FROM account WHERE username = '$username' and type ='Savings'");
	$row2 = $res2->fetch_assoc();
	//echo $row2['balance'];
//$r0['values'] = array();
$r1['name'] =$username;
//print json_encode($r1);

$r2['checking'] = $row;
//print json_encode($r2);
$r2['savings'] = $row2;
//print json_encode($r3);

$r0  = array('name'=>$username, 'Checking'=>$row['balance'],'Saving'=>$row2['balance']);
print json_encode($r0);

?>

