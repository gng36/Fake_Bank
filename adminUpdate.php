<?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $con = new mysqli("localhost", "root", "ADPadp44", "fake_bank");
	
        $username = $_POST['username'];
        $chkBal = "";
        $sveBal = "";
       

	
        if($_POST['inputdata'] == 'delete'){
                $chk = $con->query("delete from user where username='$username'");
        }
        else if($_POST['inputdata'] == 'accbal'){
                $chk = $con->query("SELECT balance FROM account WHERE username = '$username' and type ='checkings'");
                $sve = $con->query("SELECT balance FROM account WHERE username = '$username' and type ='savings'");
                $chkBal = $chk->fetch_assoc()["balance"];
                $sveBal =  $sve->fetch_assoc()["balance"];
        }
        else if($_POST['inputdata'] == 'update'){
                $chkBal = $_POST['chk'];
                $sveBal = $_POST['sve'];
                
                $chkup = $con->query("UPDATE account set balance='$chkBal' where username='$username' and type='checkings'");
                $sveup = $con->query("UPDATE account set balance='$sveBal' where username='$username' and type='savings'");

                if($chkup){
                        $chkBal = $_POST['chk'];
                }

                if($sveup){
                        $sveBal = $_POST['sve'];
                }

        }

        header("Location: admin.html?chk=$chkBal&sve=$sveBal&username=$username");
?>
