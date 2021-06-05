<?php 
include ("templates/database_conn.php");
$msg='';
$errors=array('branch'=>'');
$acc_number['c_account_number']='';
$Accountname='Current Account';
$od='10000';
$companyname='';
if (isset($_GET['userid']))
{
	$userid=mysqli_real_escape_string($conn,$_GET['userid']);
	$password=mysqli_real_escape_string($conn,$_GET['password']);
	$sql1 = "select * from customers where userid = '$userid' and password = '$password'";
  	$auresult = mysqli_query($conn, $sql1);  
  	$row = mysqli_fetch_array($auresult, MYSQLI_ASSOC);
  	 if(is_null($row))
   	{
   	 header("Location: login.php");
   	}
   }

if(isset($_GET['submit']))
{

  $branch_id=mysqli_real_escape_string($conn,$_GET['branch_id']);
  $sqlc="select * from branch where branch_id=$branch_id";
  //echo $sqlc;
  $resc=mysqli_query($conn,$sqlc);
  $arrayc=mysqli_fetch_array($resc,MYSQLI_ASSOC);
  if(is_null($arrayc))
  {
    $errors['branch']='Branch ID invalid';
  }
	$companyname=mysqli_real_escape_string($conn,$_GET['companyname']);
	$Accountname=mysqli_real_escape_string($conn,$_GET['Account_name']);
	$balance=mysqli_real_escape_string($conn,$_GET['balance']);
	$od=mysqli_real_escape_string($conn,$_GET['odamt']);
  
	$total_spendable=$od+$balance;
	$sql="INSERT INTO `current_account`(`user_id`,`account_name`, `balance`, `company_name`, `max_od`,`branch_id`) VALUES ('$userid','$Accountname','$balance','$companyname','$od','$branch_id')";
	if(mysqli_query($conn,$sql))
  {  
    $msg="Account successfully created. Your account number is "; 
  }
  else 
  {
    echo ("Error");
  }

  $sql1="SELECT c_account_number FROM `current_account` ORDER BY created_on DESC LIMIT 1";
  $k=mysqli_query($conn,$sql1);
  $acc_number=mysqli_fetch_array($k,MYSQLI_ASSOC);
  $qaz=$acc_number['c_account_number'];
  $sql2 = "INSERT INTO `current_transactions`(`account_number`,`amount`, `transaction_description`, `total_spendable`) VALUES ('$qaz','$balance','$balance opening balance ','$total_spendable')";
  $l=mysqli_query($conn,$sql2);
  //echo $sql2;
  //echo $total_spendable;
}

?>
   <!DOCTYPE html>
<html>
<head>
	<title>Bank account creation</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style type="text/css">
    .brand{
      background:#000000 !important;
    }
    .brand-text{
      color: #808080 !important;
    }
    form{
      max-width: 300px;
      margin: 40px;
      padding: 20px;
    }
  </style>	
</head>

<body class="grey lighten-4">
<nav class="white z-depth-0">
    <div class ="container">
      <a href="create_new_acc.php?userid=<?php echo($userid);?>&password=<?php echo($password);?>" class="brand-logo brand-text">Click to go back</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li>
  	</ul>
    </div>
  </nav>
  <div class="container"><h3 class="center">Current account creation</h3>
  	<h4><?php echo htmlspecialchars($msg);
  echo htmlspecialchars($acc_number['c_account_number']);
  ?>
<div class="container">
	<div class="container">
  <form class="white" action="current.php" method="GET">
  	<input type="hidden" name="password" value='<?php echo($password) ?>'>
	<input type="hidden" name="userid" value='<?php echo($userid) ?>'>
  	<label style="color:grey;font-size: 18px;">Company name</label>
  	<input type="text" name="companyname" value='<?php echo($companyname) ?>' placeholder="Working organizations name" required>
  	<label style="color:grey;font-size: 18px;">Account name</label>
  	<input type="text" name="Account_name" value='<?php echo($Accountname) ?>' required>
  	<label style="color:grey;font-size: 18px;">Opening balance</label>
  	<input type="number" name="balance" value='<?php echo($balance) ?>' required min='10000'>
  	<label style="color:grey;font-size: 18px;">max OD</label>
  	<input type="number" name="odamt" min='0' max='50000' value='<?php echo($od) ?>'>
  	
    <label style="color:grey;font-size: 18px;">Branch ID</label>
    <input type="number" name="branch_id" min='0' value='<?php echo($branch_id) ?>'>
     <div class='red-text'><?php echo $errors['branch']; ?></div>
  		<div class="center">
  			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
  		</div>
  </form>
</div>
</div>
</div>
</body>
</html>