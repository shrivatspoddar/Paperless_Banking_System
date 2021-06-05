<?php
include("templates/database_conn.php");
	if(isset($_GET['userid'])){
		$userid=mysqli_real_escape_string($conn,$_GET['userid']);
		$password=mysqli_real_escape_string($conn,$_GET['password']);
		$account=mysqli_real_escape_string($conn,$_GET['s_account_number']);
		$sql4 = "Select * from customers where userid = '$userid' and password = '$password'";
    	$auresult = mysqli_query($conn, $sql4);  
    	$row = mysqli_fetch_array($auresult, MYSQLI_ASSOC);
    if(is_null($row))
    {
     header("Location: login.php");
    }
    $sql5 = "Select * from savings_accounts where s_account_number='$account' and userid = '$userid'";
    $auresult1 = mysqli_query($conn, $sql5);  
    $row1 = mysqli_fetch_array($auresult1, MYSQLI_ASSOC);
    //print_r($row1);
    if(is_null($row1))
    {
     header("Location: login.php");
    }

    $sql5="Select * from `issued_cheques` where `reciever_ac_no` ='$account' and `status`=2";
    $res5=mysqli_query($conn,$sql5);
    $row5=mysqli_fetch_all($res5,MYSQLI_ASSOC);

    foreach($row5 as $t){
        $newbal=$row1['balance'];
        $newbal+=$t['amount'];
        $amt=$t['amount'];
        $sender=$t['issue_ac_no'];
        $sql6="update `savings_accounts` set balance='$newbal' where s_account_number='$account'";
        mysqli_query($conn,$sql6);


        $str="Cheque claimed from ".$sender;
        $sql7="INSERT INTO `savings_transactions`(`account_number`, `amount_`, `description`, `balance`) VALUES ('$account','$amt','$str','$newbal')";
        mysqli_query($conn,$sql7);

        $id=$t['cheque_id'];
        $sql8="UPDATE `issued_cheques` SET `status`=0 WHERE cheque_id='$id'";
        mysqli_query($conn,$sql8);

        header("Location: savings_claim_check.php?userid='$userid'&password='$password'&s_account_number='$account'");
    }
    $string="savings_more_info.php?userid=".$userid."&password=".$password."&s_account_number=".$account;
    header("Location: $string");
}
?>