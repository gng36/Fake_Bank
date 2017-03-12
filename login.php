
<?php

session_start();

	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	
//	$res = $mysqli->query("SELECT balance FROM account WHERE account_number = '2' and type ='Checkings'");
//$row = $res->fetch_assoc();

//echo $row['balance'];

$username= $_POST['username'];
$password= $_POST['password'];

//$username= 'user12';
//$password= 'user1';
//echo $username;
//echo $password;

$res = $mysqli->query("SELECT * FROM user WHERE username = '$username' and password ='$password'");
$row = $res->fetch_assoc();

$res2 = $mysqli->query("SELECT * FROM account WHERE username = '$username'");
$row2 = $res2->fetch_assoc();
//echo $row;
//echo $row2['account_number'];



if ($row!=0)

{
	//$res2 = $mysqli->query("SELECT account_number FROM account WHERE username = '$username'");
	//$row2 = $res2->fetch_assoc();
	//echo $row2['account_number'];
	$_SESSION['user'] =$username;
	$_SESSION['accountnumber'] = $row2['account_number'];
	echo $_SESSION['user'];
	echo $_SESSION['accountnumber'];
	$var1 = "test";

	$return['name'] = array('name'=>$username);
	echo json_encode($return);
	if ($_SESSION['user'] == 'admin'){
	header("Location: http://localhost/Fake_Bank/html_files/admin.html");
	}
	else{
	header("Location: http://localhost/Fake_Bank/html_files/accountinfo.html");
	//header("Location: http://localhost/Fake_Bank/html_files/get_acct_info.php");
	}
}


else {
	header("Location: http://localhost/Fake_Bank/html_files/Login.html");
$wp = "Wrong Password";
echo $wp;

}


?>

