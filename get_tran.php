
<?php
session_start();


$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	
$username = $_POST['username'];
$year=$_POST['year'];
$month=$_POST['month'];


$res = $mysqli->query("select t.withdraw_from_acc_num acc_w, t.acc_num_to acc_to, t.trans_time time, t.acc_num_from acc_from, t.deposit_to_acc_num acc_d, t.amount amount, t.type t_type from transaction t where (t.acc_num_to in (select account_number from account where username = '$username') or t.acc_num_from in (select account_number from account where username = '$username') or t.withdraw_from_acc_num in (select account_number from account where username = '$username') or t.deposit_to_acc_num in(select account_number from account where username = '$username')) and month(t.trans_time) = $month and year(t.trans_time) = $year ORDER BY t.trans_time");

$rows = array();

print("<html><body>");
print("<table cellpadding='5'><thead><tr><th>Transaction Type</th><th>From Account</th><th>To Account</th><th>Transaction Amount</th><th>Time</th></tr></thead><tbody>");
while($r = mysqli_fetch_assoc($res)) {
	echo "<tr>";
	echo "<td>" . $r['t_type'] . "</td>";
	if($r['t_type'] == "withdraw"){
		echo "<td>" . $r['acc_w'] . "</td>";
		echo "<td></td>";
	}
	else if($r['t_type'] == "transfer"){
		echo "<td>" . $r['acc_from'] . "</td>";
		echo "<td>" . $r['acc_to'] . "</td>";
	}
	else if($r['t_type'] == "deposit"){
		echo "<td></td>";
		echo "<td>" . $r['acc_d'] . "</td>";
	}
	else {

	}	
		
	
	echo "<td>" . $r['amount'] . "</td>";
	echo "<td>" . $r['time'] . "</td>";
	echo "</tr>";
}
print("</tbody></table>");

print("</body></html>");




?>
