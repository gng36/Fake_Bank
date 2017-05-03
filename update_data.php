<?php
session_start();

	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	
$username = $_SESSION['user'];
$checkamount= $_POST['checkamount'];
$saveamount= $_POST['saveamount'];
$inputdata=$_POST['inputdata'];
$amount=$_POST['amount'];
$accountnum=$_POST['accountnumber'];

	
	$res = $mysqli->query("SELECT account_number FROM account WHERE username = '$username' and type ='checkings'");
	$checkingnum = $res->fetch_assoc();
	$res = $mysqli->query("SELECT account_number FROM account WHERE username = '$username' and type ='savings'");
	$savingsnum = $res->fetch_assoc();

if ($inputdata == 'withdraw' and $amount < $checkamount){
$res = $mysqli->query("insert into transaction (type, withdraw_from_acc_num, amount) values ('withdraw',". $checkingnum['account_number'] . ", " . $amount .")");
	
header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}
else if($inputdata == 'deposit'){
	
$res = $mysqli->query("insert into transaction (type, deposit_to_acc_num, amount) values ('deposit',". $checkingnum['account_number'] . ",".$amount.")");

header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}
else if($inputdata == 'Ctransfer' and $amount < $saveamount){
	$res = $mysqli->query("insert into transaction (type, acc_num_to, acc_num_from, amount) values ('transfer'," . $checkingnum['account_number'] . "," . $savingsnum['account_number'] . "," . $amount . ")");

header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}
else if($inputdata == 'Stransfer' and $amount < $checkamount){
	$res = $mysqli->query("insert into transaction (type, acc_num_to, acc_num_from, amount) values ('transfer'," . $savingsnum['account_number'] . "," . $checkingnum['account_number'] . "," . $amount . ")");

header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}
else {
echo 'invalid value';
header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}

$r2['checking'] = $row;

$r2['savings'] = $row2;

$r0  = array('name'=>$username, 'Checking'=>$row['balance'],'Saving'=>$row['balance']);


?>
