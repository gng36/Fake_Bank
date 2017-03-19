
<?php
session_start();


	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");

	
$username = $_SESSION['user'];




	
	$res = $mysqli->query("SELECT balance FROM account WHERE username = '$username' and type ='Checkings'");
	$row = $res->fetch_assoc();
	

	$res2 = $mysqli->query("SELECT balance FROM account WHERE username = '$username' and type ='Savings'");
	$row2 = $res2->fetch_assoc();

	$r1['name'] =$username;


	$r2['checking'] = $row;

	$r2['savings'] = $row2;


	$chk = $mysqli->query("SELECT interest_rate FROM account WHERE username = '$username' and type ='Checkings'");
	$c_row = $chk->fetch_assoc();

	$svn = $mysqli->query("SELECT interest_rate FROM account WHERE username = '$username' and type ='Savings'");
	$s_row = $svn->fetch_assoc();

	$chkMonIn = $row['balance'] * (($c_row['interest_rate'] / 100) / 12);
	$savMonIn = $row2['balance'] * (($s_row['interest_rate'] / 100) / 12);
	$r0  = array('name'=>$username, 'Checking'=>$row['balance'],'Saving'=>$row2['balance'], 'chk_month_in'=>$chkMonIn, 'sav_month_in'=>$savMonIn);
	print json_encode($r0);

?>

