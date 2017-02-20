<?php
	$con = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	$query_col = "insert into user (";
	$query_val = "(";
	foreach( $_POST as $col_name => $val) {
	    if( is_array( $col_name ) ) {
		foreach( $col_name as $thing ) {
		    /*echo $thing;*/
		}
	    } else {
		if($val != ""){
			$query_col = $query_col . $col_name . ", ";
			$query_val = $query_val . "'" .$val . "', ";
		}
	    }
	}
	//$query_col = trim($query_col);
	//echo $query_col;
	$finQuery = rtrim($query_col, ", ") . ")  values " . rtrim($query_val, ", ") . ");";
	echo $finQuery;
	$con->query($finQuery);
	

?>
