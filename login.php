
<?php

session_start();
$username= $_POST['username'];
$upassword= $_POST['password'];
#$username= 'tod';
#$upassword= 'tod';


try
{
	//$mdb = new MongoDB\Driver\Manager("mongodb://itdemo:12345@ds015859.mlab.com:15859/635");
	$mdb = new MongoDB\Driver\Manager("mongodb://gng36:gng36@ds159200.mlab.com:59200/it635");
	$filter = array('username'=> $upassword);
	$query = new MongoDB\Driver\query($filter);
	$results = $mdb->executeQuery("it635.userdata",$query);
	$res = $results->toArray();
	//var_dump($res);
	//print_r($res);

    foreach ($res as $res) {
    $hashpassword = $res->password;
        //echo "$res->username : $res->password\n";
   	 }
	//echo $hashpassword;

 if(password_verify($upassword,$hashpassword)){
//echo 'it works' ;



//if ($row!=0){
//	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");	
//	$res = $mysqli->query("SELECT balance FROM account WHERE account_number = '2' and type ='Checkings'");
//$row = $res->fetch_assoc();

//echo $row['balance'];

//$username= $_POST['username'];
//$password= $_POST['password'];

//$username= 'user12';
//$password= 'user1';
//echo $username;
//echo $password;

$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
//$res = $mysqli->query("SELECT * FROM user WHERE username = '$username' and password ='$password'");
//$row = $res->fetch_assoc();

$res2 = $mysqli->query("SELECT * FROM account WHERE username = '$username'");
$row2 = $res2->fetch_assoc();
//echo $row;
//echo $row2['account_number'];



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


}
catch(exception $e)
{
	print_r($e);
}

?>

