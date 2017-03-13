
<?php
session_start();

//echo $_SESSION['user'];
//echo $_SESSION['accountnumber'] ;
	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");

	//$username= 'user12';
//$username = $_SESSION['user'];
//echo $row['balance'];
$username=$_POST['name1'];
$checkamount= $_POST['checkamount'];
$saveamount= $_POST['saveamount'];
$inputdata=$_POST['inputdata'];
$accountnum=$_POST['accountnumber'];


/*echo $username;
echo "<div></div>";
echo $checkamount;
echo "<div></div>";
echo $saveamount;
echo "<div></div>";
echo $inputdata;
echo "<div></div>";
echo $amount;
echo "<div></div>";
echo $accountnum;
echo "<div></div>";*/

	
	$res = $mysqli->query("SELECT account_number FROM account WHERE username = '$username' and type ='checkings'");
	$checkingnum = $res->fetch_assoc();

	$res = $mysqli->query("SELECT account_number FROM account WHERE username = '$username' and type ='savings'");
	$savingsnum = $res->fetch_assoc();
/*echo $savingsnum['account_number'];
echo "<div></div><div>checking</div>";
echo $checkingnum['account_number'];
echo "<div></div>";*/

//echo $inputdata;
if ($inputdata == 'delete' and $amount < $checkamount){
$res = $mysqli->query("insert into transaction (type, withdraw_from_acc_num, amount) values ('withdraw',". $checkingnum['account_number'] . ", " . $amount .")");
	
header("Location: http://localhost/Fake_Bank/html_files/admin.html");
}

else if($inputdata == 'deposit'){
	//echo "insert into transaction (type, deposit_to_acc_num, amount) values ('deposit',". $checkingnum['account_number'] . ", " . $amount .")";
$res = $mysqli->query("insert into transaction (type, deposit_to_acc_num, amount) values ('deposit',". $checkingnum['account_number'] . ",".$amount.")");
//$row = $res->fetch_assoc();
header("Location: http://localhost/Fake_Bank/html_files/admin.html");
}
else if($inputdata == 'Ctransfer' and $amount < $saveamount){
	$res = $mysqli->query("insert into transaction (type, acc_num_to, acc_num_from, amount) values ('transfer'," . $checkingnum['account_number'] . "," . $savingsnum['account_number'] . "," . $amount . ")");
	//$row = $res->fetch_assoc();
//echo $row;
header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}
else if($inputdata == 'Stransfer' and $amount < $checkamount){
	$res = $mysqli->query("insert into transaction (type, acc_num_to, acc_num_from, amount) values ('transfer'," . $savingsnum['account_number'] . "," . $checkingnum['account_number'] . "," . $amount . ")");
//$row = $res->fetch_assoc();
//echo $row;
header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}
else {
echo 'invalid value';
header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
}


//echo $username;


	
	//$res = $mysqli->query("SELECT balance FROM account WHERE username = '$username' and type ='Checkings'");
	//$row = $res->fetch_assoc();
	//echo $row['balance'];
//$res2 = $mysqli->query("SELECT balance FROM account WHERE username = '$username' and type ='Savings'");
//$row2 = $res2->fetch_assoc();
//echo $row2['balance'];
//$r0['values'] = array();
//$r1['name'] =$username;
//print json_encode($r1);

$r2['checking'] = $row;
//print json_encode($r2);
$r2['savings'] = $row2;
//print json_encode($r3);

$r0  = array('name'=>$username, 'Checking'=>$row['balance'],'Saving'=>$row['balance']);
//print json_encode($r0);

?>
