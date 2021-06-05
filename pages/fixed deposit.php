<?php 
include ("templates/database_conn.php");
$Accountname='Fixed Deposit';
$balance='0';
$fdtype='0';
$acc_number['fd_account_number']='';
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
  $balance=mysqli_real_escape_string($conn,$_GET['balance']);
  $fdtype=mysqli_real_escape_string($conn,$_GET['fdtype']);

  if ($fdtype==1.15) $years=5;
  if ($fdtype==1.17) $years=7;
  if ($fdtype==1.20) $years=10;
  $finalreturns=$balance*$fdtype;
  if ($sub=='IF sure click here to create')
  {
  //echo ('hello');
  $rate_of_intrest=(-100+($fdtype*100));
  $sql="INSERT INTO `fixed_deposits`(`user_id`, `account_name`, `bond_duration`, `rate_of_intrest`,`final_amount`, `branch_id`) VALUES ('$userid','$Accountname','$years','$rate_of_intrest','$finalreturns','$branch_id')";
  if(mysqli_query($conn,$sql))
  {

    $msg ="Fixed deposit account is created.";
    $sql1="SELECT fd_account_number FROM `fixed_deposits` ORDER BY created_on DESC LIMIT 1";
    $k=mysqli_query($conn,$sql1);
    $acc_number=mysqli_fetch_array($k,MYSQLI_ASSOC);
    $qaz=$acc_number['fd_account_number'];

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

<div class="container"><h3 class="center">Fixed deposit creation</h3>
  <h4><?php echo htmlspecialchars($msg); ?></h4><br>
  <h4>Account number is <?php echo htmlspecialchars($qaz); ?></h4>
<div class="container">
  <div class="container">
  <form class="white" action="fixed deposit.php" method="GET">
    <input type="hidden" name="password" value='<?php echo($password) ?>'>
    <input type="hidden" name="userid" value='<?php echo($userid) ?>'>


    <label style="color:grey;font-size: 18px;">Account name</label>
    <input type="text" name="Account_name" value='<?php echo($Accountname) ?>' required>
    <label style="color:grey;font-size: 18px;">Opening balance</label>
    <input type="number" name="balance" value='<?php echo($balance) ?>' required min='50000'>
    <label style="color:grey;font-size: 18px;">Type of FD</label>
    <div>
    <label for="fdtype" style="color:black;font-size: 18px;">Choose a type:<h4 style="color:red;font-size: 18px;"><?php echo(-100+$fdtype*100) ?>% interest</h4></label></div>
    <select id="fdtype" name="fdtype" class="browser-default">
        <option value="1.15">15%,5 years</option>
        <option value="1.17">17%,7 years</option>
        <option value="1.20">20%,10 years</option>
    </select>
    <input type="hidden" name="finalreturns" value='<?php echo($finalreturns); ?>'>
    <input type="hidden" name="years" value='<?php echo($years); ?>'>
     <label style="color:grey;font-size: 18px;">Branch ID</label>
      <input type="number" name="branch_id" min='0' value='<?php echo($branch_id) ?>'>
     <div class='red-text'><?php echo $errors['branch']; ?></div>
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