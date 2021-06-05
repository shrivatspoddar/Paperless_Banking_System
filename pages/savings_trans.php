<?php
$errors = array('pass' =>'','acnumber' =>'','amount'=>'');
$recacc='';

include("templates/database_conn.php");
	if(isset($_GET['userid'])){
		$userid=mysqli_real_escape_string($conn,$_GET['userid']);
		$password=mysqli_real_escape_string($conn,$_GET['password']);
		$account=mysqli_real_escape_string($conn,$_GET['s_account_number']);
		$sql4 = "Select * from customers where userid = '$userid' and password = '$password'";
    	$auresult = mysqli_query($conn, $sql4);  
    	$row = mysqli_fetch_array($auresult, MYSQLI_ASSOC);
    	//print_r($row);
 if(is_null($row))
    {
     header("Location: login.php");
    }
}

if (isset($_GET['submit']))
{
  $pass=mysqli_real_escape_string($conn,$_GET['pass']);
  if ($pass!=$password)
  {
  	$errors['pass']='Wrong Passcode';
  }
  $amount=mysqli_real_escape_string($conn,$_GET['trans_amt']);
  $type=mysqli_real_escape_string($conn,$_GET['type']);
  $benname=mysqli_real_escape_string($conn,$_GET['benname']);
  if ($type==' deposit ')
  {
  	$coeff=1;
  }
  else
  {
	$coeff=-1;
  }
  $amount*=$coeff;
  //echo($amount);
  $description= $_GET['trans_amt'].$type;
  if ($type==' bank transfer to ')
  {
  	$description=$description.$_GET['to_acc']." held by ".$_GET['benname']."( IFSC: ".$_GET['ifsc']."  )";
  	//echo($description);
  }
  if ($type==' money transfer to ')
  {
  	$description=$description.$_GET['to_acc'];
  	$recacc=mysqli_real_escape_string($conn,$_GET['to_acc']);
  	//echo $recacc;
  	$sqld="select * from loan_accounts where user_id=$userid and loan_account_number=$recacc";
  	$resd=mysqli_query($conn,$sqld);
  	$arrayd=mysqli_fetch_array($resd,MYSQLI_ASSOC);
  	if (is_null($arrayd))
  	{
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
  			$ramt=$amount*-1;
  			$string=$ramt." deposit";
  			//echo $string;
  			$total_spendable=$arraye["balance"]+$arraye['max_od'];
  			$total_spendable+=$ramt;
  			$sqlf="INSERT INTO `current_transactions`(`account_number`,`amount`, `transaction_description`, `total_spendable`) VALUES ('$recacc','$ramt','$string','$total_spendable')";
  			$total_spendable-=$arraye['max_od'];
  			//echo ($total_spendable);
  			$sqlg="update current_account set balance='$total_spendable' where c_account_number='$recacc' ";
  			mysqli_query($conn,$sqlf);
  			mysqli_query($conn,$sqlg);
  		}
  	  }
      else if ($arrayj['userid']==$userid)
      {
        $errors['acnumber']='cant transfer to same type of account of same user';
      }
  	  else
  	  {
  	  	$ramt=$amount*-1;
  		$string=$ramt." deposit";
  		$total_balance=$arrayj["balance"];
  		$total_balance+=$ramt;
  		$sqlk="INSERT INTO `savings_transactions`(`account_number`,  `amount_`, `description`, `balance`) VALUES ('$recacc','$ramt','$string','$total_balance')";
  		mysqli_query($conn,$sqlk);
  		$sqll="update savings_accounts set balance=$total_balance where s_account_number=$recacc";
  		mysqli_query($conn,$sqll);

  	  }
  	}
  	else
  	{
  		$ramt=$amount*-1;
  		$total_due=$arrayd['amount'];
  		$total_due+=$ramt;
  		//echo ($total_due);
  		$sqlh="INSERT INTO `loan_payments`(`loan_account_number`, `amount_paid`, `amount`) VALUES ('$recacc','$ramt','$total_due')";
  		mysqli_query($conn,$sqlh);
  		$sqli="UPDATE `loan_accounts` SET `amount`='$total_due' where loan_account_number='$recacc'";
  		mysqli_query($conn,$sqli);

  	}
  	//print_r($arrayd);


  }
  //echo htmlspecialchars($description);
  $sqla="select * from savings_transactions where account_number=$account order by timestamp_ desc limit 1 ";
  $resa=mysqli_query($conn,$sqla);
  $array=mysqli_fetch_array($resa,MYSQLI_ASSOC);
  $balance=$array['balance']+$amount;
  if ($balance<0)
  {
  	$errors['amount']='insufficient funds';
  }
  //print_r($array);
  //echo htmlspecialchars($array['balance']);
  if(array_filter($errors))
  {

  }
  else
  {
  $sqlb="INSERT INTO `savings_transactions`(`account_number`, `amount_`, `description`, `balance`) VALUES ('$account','$amount','$description','$balance')";
  $sqlc="update savings_accounts set balance=$balance where s_account_number=$account";
  //mysqli_query($conn,$sqlb);
  //mysqli_query($conn,$sqlc);
  mysqli_query($conn,$sqlb);
  mysqli_query($conn,$sqlc);
  }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Savings transactions</title>
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
  	<h3 class="center">NEW TRANSACTION</h3>
  	<h4 class="center">(<?php echo htmlspecialchars($account); ?>)</h4>
	<form method="GET" class="white">
		<p>
		<div class="container">
		<div class="container">
			<h6>Type of transaction</h6>
			<input type="hidden" name="password" value='<?php echo($password); ?>'>
    		<input type="hidden" name="userid" value='<?php echo($userid); ?>'>
    		<input type="hidden" name="s_account_number" value='<?php echo($account); ?>'>
		<!-- <label style="color:grey;font-size: 18px;">
			<input type="radio" name="type" value=" bank transfer to ">
			<span>Transfer to other account(For Reference Only)</span>
		</label> -->
		</p>
		<label style="color:grey;font-size: 18px;">
			<input type="radio" name="type" checked value=" money transfer to ">
			<span>Transfer to account in this bank</span>
		</label>
		<!-- <p>
		<label style="color:grey;font-size: 18px;">
			<input type="radio" name="type" value=" deposit ">
			<span>deposit(for demo only)</span>
		</label>
		</p>
		<p>
		<label style="color:grey;font-size: 18px;">
			<input type="radio" name="type" value=" withdrawal ">
			<span>withdrawal(for demo only)</span>
		</label>
		</p> -->
	</div>
</div>
	<div class="container">
		<div class="container">
			<label style="color:black;font-size: 18px;">Amount</label>
			<input type="number" name="trans_amt" required min='1'>
			<div class="red-text"><?php echo htmlspecialchars( $errors['amount']);?></div>
		
	<label style="color:black;font-size: 18px;">Passcode</label>
	<input type="password" name="pass">
	<div class="red-text"><?php echo htmlspecialchars( $errors['pass']);?></div>
	<label style="color:black;font-size: 18px;">Benificiary Account Number</label>
	<input type="number" name="to_acc" placeholder="Required" >	
	<div class="red-text"><?php echo htmlspecialchars( $errors['acnumber']);?></div>
	<label style="color:black;font-size: 18px;">Beneficiary Name</label>
	<input type="text" name="benname" placeholder="Required">
	<label style="color:black;font-size: 18px;">IFSC </label>
	<input type="text" name="ifsc" placeholder="">
		</div>
	</div>
		<div class="center">
  			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
  		</div>
	</p>
	</form>
</div>
</div>
</body>
</html>