<?php 
include ('templates/database_conn.php');
$countxx =1;
if(isset($_GET['userid'])){
$id=mysqli_real_escape_string($conn,$_GET['userid']);
$userid=$id;
$password=mysqli_real_escape_string($conn,$_GET['password']);
$account=mysqli_real_escape_string($conn,$_GET['s_account_number']);
$no=mysqli_real_escape_string($conn,$_GET['cqid']);
$sql4 = "select * from customers where userid = '$userid' and password = '$password'";
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
$sql="select * from savings_accounts where s_account_number=$account";
$res=mysqli_query($conn,$sql);
$accountinfo=mysqli_fetch_array($res,MYSQLI_ASSOC);



if(is_null($accountinfo))
    {
     header("Location: login.php");
    }
}
else{
    header("location : login.php");
}

$sql6="Select * from `issued_cheques` where cheque_id='$no'";
    $res6=mysqli_query($conn,$sql6);
    $t=mysqli_fetch_array($res6,MYSQLI_ASSOC);
    // print_r($row6);
        $newbal=$row1['balance'];
        $newbal+=$t['amount'];
        $amt=$t['amount'];
        $sender=$t['issue_ac_no'];
        echo $sql6="update `savings_accounts` set balance='$newbal' where s_account_number='$account'";
        mysqli_query($conn,$sql6);


        $str="Cheque claimed from ".$sender;
        echo $sql7="INSERT INTO `savings_transactions`(`account_number`, `amount_`, `description`, `balance`) VALUES ('$account','$amt','$str','$newbal')";
        mysqli_query($conn,$sql7);

        $id=$t['cheque_id'];
        echo $sql8="UPDATE `issued_cheques` SET `status`=0 WHERE cheque_id='$id'";
        mysqli_query($conn,$sql8);
        $string="savings_view_all_cheques.php?userid=".$userid."&password=".$password."&s_account_number=".$account;
        header("Location: $string");
?>