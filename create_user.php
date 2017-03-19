<?php
	$con = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	$query_col = "insert into user (";
	$query_val = "(";
	foreach( $_POST as $col_name => $val) {
	    if( is_array( $col_name ) ) {
		foreach( $col_name as $thing ) {
		   
		}
	    } else {
		if($val != ""){
			$query_col = $query_col . $col_name . ", ";
			$query_val = $query_val . "'" .$val . "', ";
		}
	    }
	}
	
	$finQuery = rtrim($query_col, ", ") . ")  values " . rtrim($query_val, ", ") . ");";
	
	$con->query($finQuery);
	
	$con->query("insert into account (type, username, balance, interest_rate) values ('savings','". $_POST['username'] ."', 0.00, 1.0000)");
	$con->query("insert into account (type, username, balance, interest_rate) values ('checkings','". $_POST['username'] ."', 0.00, 0.0000)");
	header("Location: http://localhost/Fake_Bank/html_files/Login.html");

	

?>
