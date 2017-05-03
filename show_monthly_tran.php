
<?php
session_start();


$mysqli = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	
$username = $_POST['username'];
$vendor=$_POST['vendor'];
$acc_num=$_POST['acc_num'];
$address = $_POST['address'];
$amount = $_POST['amount'];
$payment_freq=$_POST['payment_freq'];
$total = 0;


$res = $mysqli->query("select * from transaction where type='month_pay'");

$rows = array();

print("<html><body>");
print("<div>View your monthly transaction below.</div>");
//print("<form action='delete_month.php' method='post'>");
print("<table cellpadding='5'><thead><tr><th>Vendor</th><th>Address</th><th>Account Number</th><th>Transaction Amount</th></tr></thead><tbody>");
while($r = mysqli_fetch_assoc($res)) {
	echo "<tr>";
	echo "<td style='text-align:center'>" . $r['vendor'] . "</td>";
	echo "<td style='text-align:center'>" . $r['address'] . "</td>";
	echo "<td style='text-align:center'>" . $r['withdraw_from_acc_num'] . "</td>";
	echo "<td style='text-align:center'>" . $r['amount'] . "</td>";
	//echo "<td style='text-align:center'><input type='hidden' name='id' value='" . $r['trans_id'] . "' /></td>";
	//echo "<td style='text-align:center'><input type='submit' value='Delete' /></td>";
echo "<td style='text-align:center'><a href='delete_month.php?id=".$r['trans_id']."'s>Delete</a></td>";
	echo "</tr>";
	$total = $total + $r['amount'];
}
print("</tbody></table>");
//print("</form>");
print("Monthly Total: $$total");
print("</body></html>");

?>
