<?php
$errors = array('pass' =>'','acnumber' =>'','amount'=>'','DOC'=>'');
$recacc='';
$pass='';
$amount='';
$DOC=date("Y-m-d");

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
    if(is_null($row1))
    {
     header("Location: login.php");
    }
}

if (isset($_GET['submit']))
{
  $pass=mysqli_real_escape_string($conn,$_GET['pass']);
  if ($pass!=$password)
  {
  	$errors['pass']='invalid password';
  }
  $amount=mysqli_real_escape_string($conn,$_GET['trans_amt']);
        if($amount>$row1['balance']+10000){
            $errors['amount']="insufficient funds";
        }
        if($amount<500){
            $errors['amount']="Cheque transfer: Enter atleast 500 and above";
        }
  $recacc=mysqli_real_escape_string($conn,$_GET['to_acc']);
  $DOC=mysqli_real_escape_string($conn,$_GET['DOC']);
  if($DOC<=date("Y-m-d")){
    $errors['DOC']="Date must be after ".date("Y-m-d");
  }

  if(array_filter($errors)){
		//echo errors;
	}
	
else{
      $sqlj="select * from savings_accounts where s_account_number=$recacc";
  		$resj=mysqli_query($conn,$sqlj);
  		$arrayj=mysqli_fetch_array($resj,MYSQLI_ASSOC);
  		if (is_null($arrayj))
  		{
        $sqle="select * from current_account where c_account_number=$recacc";
        $rese=mysqli_query($conn,$sqle);
        $arraye=mysqli_fetch_array($rese,MYSQLI_ASSOC);
        if (is_null($arraye))
        {
          $errors['acnumber']='Wrong account number';
        }
        else
        {
          echo $sqlissue="INSERT INTO `issued_cheques`(`issue_ac_no`, `reciever_ac_no`, `amount`, `date_of_claim`) VALUES ('$account','$recacc','$amount','$DOC')";
          $resissue=mysqli_query($conn,$sqlissue);

          $total_balance=$row1['balance']-$amount;
          $sqlded="update savings_accounts set balance=$total_balance where s_account_number=$account";
          $resded=mysqli_query($conn,$sqlded);

          $string='Cheque transfer issue from '.$account.' to '.$recacc;
          $sqltrans="INSERT INTO `savings_transactions`(`account_number`,  `amount_`, `description`, `balance`) VALUES ('$account','$amount','$string','$total_balance')";
          $restrans=mysqli_query($conn,$sqltrans);
          header("Location: savings_more_info.php?userid=".$userid."&password=".$password."&s_account_number=".$account);
        }
  	  }
      else if ($arrayj['s_account_number']==$account)
      {
        $errors['acnumber']='Transfer to self isnt supported';
      }
  	  else
  	  {
        echo $sqlissue="INSERT INTO `issued_cheques`(`issue_ac_no`, `reciever_ac_no`, `amount`, `date_of_claim`) VALUES ('$account','$recacc','$amount','$DOC')";
        $resissue=mysqli_query($conn,$sqlissue);

        $total_balance=$row1['balance']-$amount;
        $sqlded="update savings_accounts set balance=$total_balance where s_account_number=$account";
        $resded=mysqli_query($conn,$sqlded);

        $string='Cheque transfer issue from '.$account.' to '.$recacc;
        $sqltrans="INSERT INTO `savings_transactions`(`account_number`,  `amount_`, `description`, `balance`) VALUES ('$account','$amount','$string','$total_balance')";
        $restrans=mysqli_query($conn,$sqltrans);
        header("Location: savings_more_info.php?userid=".$userid."&password=".$password."&s_account_number=".$account);

  	  }
  	
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISSUE CHECK PAGE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style type="text/css">
    .brand{
      background:#000000 !important;
    }
    .brand-text{
      color: #808080 !important;
    }
    form{
      max-width: 600px;
      margin: 40px;
      padding: 20px;
    }
  </style>
  <body class="grey lighten-4" >
  <nav class="white z-depth-0">
    <div class ="container">
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li>
    </ul>
      <a href="index.php?userid=<?php echo($userid);?>&password=<?php echo($password);?>" class="brand-logo brand-text">BANK</a>
      
    </div>
  </nav>
<style type="text/css">
.h4{

	margin-left:75px;
	margin-right:75px;	
}
</style>
</head>
<body>
<div class="container">
  <div class="container">
  	<h3 class="center">ISSUE NEW CHEQUE</h3>
  	<h4 class="center">A/C NO: <?php echo htmlspecialchars($account); ?></h4>
      <form method="GET" class="white">
		<p>
		<div class="container">
		<div class="container">
			<input type="hidden" name="password" value='<?php echo($password); ?>'>
    		<input type="hidden" name="userid" value='<?php echo($userid); ?>'>
    		<input type="hidden" name="s_account_number" value='<?php echo($account); ?>'>


            <label style="color:black;font-size: 18px;">Amount</label>
			<p>Rs:<input type="number" name="trans_amt" required value='<?php echo htmlspecialchars($amount) ?>'></p>
			<div class="red-text"><?php echo htmlspecialchars( $errors['amount']);?></div>


            <label style="color:black;font-size: 18px;">Passcode</label>
	        <input type="password" name="pass" value='<?php echo htmlspecialchars($pass) ?>'>
	        <div class="red-text"><?php echo htmlspecialchars( $errors['pass']);?></div>


            <label style="color:black;font-size: 18px;">Beneficiary Account Number</label>
	        <input type="number" name="to_acc" placeholder="" value='<?php echo htmlspecialchars($recacc) ?>'>	
	        <div class="red-text"><?php echo htmlspecialchars( $errors['acnumber']);?></div>

            <label style="color:grey;font-size: 18px;">Date of Claim</label>
  		    <input type="date" name="DOC" value='<?php echo htmlspecialchars($DOC) ?>'>
  		    <div class="red-text"><?php echo htmlspecialchars( $errors['DOC']) ?></div>

        <div class="center">
  			<input type="submit" name="submit" value="Issue Cheque" class="btn brand z-depth-0"></input>
  		</div>

</body>
</html>