<?php 
include ("templates/database_conn.php");
$Accountname='loan account';
$ltype='0';
$amount='0';
$acc_number['loan_account_number']='';
$qaz='';
$msg='';
$years='';
$errors=array('branch'=>'');
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
  $sub=mysqli_real_escape_string($conn,$_GET['submit']);
  $Accountname=mysqli_real_escape_string($conn,$_GET['Account_name']);
  $amount=mysqli_real_escape_string($conn,$_GET['amount']);
  $ltype=mysqli_real_escape_string($conn,$_GET['ltype']);
 
  if ($ltype==1.15) $years=5;
  if ($ltype==1.2) $years=7;
  if ($ltype==1.25) $years=10;
  $finalpay=(-1*$amount*$ltype);
   if ($sub=='IF sure click here to create')
  {
    //echo ('hello');
    $roi=(-100+($ltype*100));
    $sql="INSERT INTO `loan_accounts`(`user_id`, `branch_id`, `account_name`, `amount`, `rate_of _intrest`, `duration_of_loan`) VALUES ('$userid','$branch_id','$Accountname','$finalpay','$roi','$years')";
    //echo ($sql);
    if(mysqli_query($conn,$sql))
  {

    $msg ="Loan account is created.";
    $sql1="SELECT loan_account_number FROM `loan_accounts` ORDER BY created_on DESC LIMIT 1";
    $k=mysqli_query($conn,$sql1);
    $acc_number=mysqli_fetch_array($k,MYSQLI_ASSOC);
    $qaz=$acc_number['loan_account_number'];
    }


  }
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
  <div class="container"><h3 class="center">Loan account creation</h3>
    <h4><?php echo htmlspecialchars($msg); ?></h4><br>
  <h4>Account number is <?php echo htmlspecialchars($qaz); ?></h4>
  <div class="container">
  <div class="container">
  <form class="white" action="loan.php" method="GET">
    <input type="hidden" name="password" value='<?php echo($password) ?>'>
    <input type="hidden" name="userid" value='<?php echo($userid) ?>'>
    <label style="color:grey;font-size: 18px;">Account name</label>
    <input type="text" name="Account_name" value='<?php echo($Accountname) ?>' required>
    <label style="color:grey;font-size: 18px;">Loan Amount</label>
    <input type="number" name="amount" value='<?php echo($amount) ?>' required min='50000'>
    <label style="color:grey;font-size: 18px;">Type of loan account</label>
    <div><label for="fdtype" style="color:black;font-size: 18px;">Choose a type:<h4 style="color:red;font-size: 18px;"><?php echo(-100+$ltype*100) ?>% interest</h4></label></div>
    <select id="ltype" name="ltype" class="browser-default">
    <option value="1.15">15% ,5 years</option>
    <option value="1.2">20%,7 years</option>
    <option value="1.25">25%,10 years</option>
  </select>

  <label style="color:grey;font-size: 18px;">Branch ID</label>
      <input type="number" name="branch_id" min='0' value='<?php echo($branch_id) ?>'>
     <div class='red-text'><?php echo $errors['branch']; ?></div>
     
   <input type="hidden" name="finalpay" value='<?php echo($finalpay); ?>'>
   <input type="hidden" name="years" value='<?php echo($years);?>'>
    
      <div class="center">
        <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
      </div>
      <br>
      <div class="center">
         <input type="submit" name="submit" value="IF sure click here to create" class="btn brand z-depth-0"></input>
      </div> 
  </form>
</div>
</div>
</div>



</body>
</html>