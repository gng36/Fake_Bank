
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

	try
{
	##$mdb = new MongoDB\Driver\Manager("mongodb://itdemo:12345@ds015859.mlab.com:15859/635");
	$mdb = new MongoDB\Driver\Manager("mongodb://gng36:gng36@ds159200.mlab.com:59200/it635");
	$command = new MongoDB\Driver\Command(['ping' => 1]);
	$mdb->executeCommand('db', $command);
	$servers = $mdb->getServers();
	#print_r($servers);
	$filter = array('name'=>'stumpy');
	$query = new MongoDB\Driver\query($filter);
	$results = $mdb->executeQuery("it635.gng36",$query);
	#print_r($results->toArray());
 	
	#$collection = $mdb->userdata; 
	$username= $_POST['username'];
        $temp  = $_POST['password'];
	#$username= 'tod';
        #$temp  = 'tod';


        $options = array('cost' => 10);

	$pass = password_hash($temp, PASSWORD_BCRYPT, $options);
    
        $arrays = array(
            "username"    => $username,
            "password"      => $pass
         );


/*
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert($arrays);

$mdb->executeBulkWrite('it635.userdata', $bulk);

$filter = ['x' => ['$gt' => 1]];
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['x' => -1],
];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $mdb->executeQuery('it635.userdata', $query);

foreach ($cursor as $document) {
    var_dump($document);
}*/
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->insert($arrays);

$mdb->executeBulkWrite('it635.userdata', $bulk);


 }
catch(exception $e)
{
	print_r($e);
}



	header("Location: http://localhost/Fake_Bank/html_files/Login.html");

	

?>
