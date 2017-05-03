<?php
	$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	//echo $_GET['id'];
	
	$res = $mysqli->query("delete from transaction where type='month_pay' and trans_id=".$_GET['id']);

		header("Location: http://localhost/Fake_Bank/html_files/show_monthly_tran.php");

?>
