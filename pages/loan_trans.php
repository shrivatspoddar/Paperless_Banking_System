<?php
include("templates/database_conn.php");
	if(isset($_GET['userid'])){
		$userid=mysqli_real_escape_string($conn,$_GET['userid']);
		$password=mysqli_real_escape_string($conn,$_GET['password']);
		$account=mysqli_real_escape_string($conn,$_GET['loan_account_number']);
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
  $trans_amt=mysqli_real_escape_string($conn,$_GET['trans_amt']);
  $pass=mysqli_real_escape_string($conn,$_GET['pass']);
  if ($pass!=$password){
    ECHO ("incorrect pin");
  }
  else
  {
    $sqla="select * from loan_accounts where loan_account_number=$account";
    $resa=mysqli_query($conn,$sqla);
    $arraya=mysqli_fetch_array($resa,MYSQLI_ASSOC);
    if (is_null($arraya))
    {
      echo ("error in account number");
    }
    else
    {
      $amount_due=$arraya['amount']+$trans_amt;
      $sqlb="INSERT INTO `loan_payments`(`loan_account_number`, `amount_paid`, `amount`) VALUES ('$account','$trans_amt','$amount_due')";
      mysqli_query($conn,$sqlb);
      $sqlc="update loan_accounts set amount='$amount_due' where loan_account_number='$account'";
      mysqli_query($conn,$sqlc);
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>loan payments</title>
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
      <a href="loan_more_info.php?userid=<?php echo($userid);?>&password=<?php echo($password);?>&loan_account_number=<?php echo($account);?>" class="brand-logo brand-text">Click to go back</a>
      
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
  	<h3 class="center">New Loan Payment</h3>
    <h3 class='center'>(<?php echo htmlspecialchars($account); ?>)</h3>
	<form method="GET" class="white">
		<p>
			<input type="hidden" name="password" value='<?php echo($password); ?>'>
    		<input type="hidden" name="userid" value='<?php echo($userid); ?>'>
    		<input type="hidden" name="loan_account_number" value='<?php echo($account); ?>'>
		<div class="container">
		<div class="container">
			<label style="color:black;font-size: 18px;">Amount</label>
			<input type="number" name="trans_amt" min='1' required>
		
	<label style="color:black;font-size: 18px;">Passcode</label>
	<input type="password" name="pass" required>	
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