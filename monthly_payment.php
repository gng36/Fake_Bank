<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

session_start();

$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");

$username = $_POST['username'];
$vendor=$_POST['vendor'];
$acc_num=$_POST['acc_num'];
$address = $_POST['address'];
$amount = $_POST['amount'];
$payment_freq=$_POST['payment_freq'];

//echo $username . " " . $vendor . " " . $acc_num . " " . $address . " " . $payment_freq;

$res = $mysqli->query("SELECT account_number FROM account WHERE username = '$username' and type ='$acc_num'");
$acc_num = $res->fetch_assoc();

//echo $acc_num['account_number'];
echo "insert into transaction (type, withdraw_from_acc_num, amount, vendor, address) values ('month_pay'," . $acc_num['account_number'] . ", " . $amount .", '" . $vendor . "', '" . $address . "', '" . $payment_freq . "')";

$res = $mysqli->query("insert into transaction (type, withdraw_from_acc_num, amount, vendor, address, payment_freq) values
('month_pay'," . $acc_num['account_number'] . ", " .  $amount .", '" . $vendor . "', '" . $address . "', '" . $payment_freq . "')");
	
header("Location: http://localhost/Fake_Bank/html_files/show_monthly_tran.php"); 


?>
