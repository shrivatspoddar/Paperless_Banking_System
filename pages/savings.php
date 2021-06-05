<?php 
include ("templates/database_conn.php");
$msg='';
$errors=array('branch'=>'');
$acc_number['s_account_number']='';
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

$Accountname='Savings Account';
if(isset($_GET['submit']))
{
  $branch=mysqli_real_escape_string($conn,$_GET['branch']);
  $sqlc="select * from branch where branch_id=$branch";
  //echo $sqlc;
  $resc=mysqli_query($conn,$sqlc);
  $arrayc=mysqli_fetch_array($resc,MYSQLI_ASSOC);
  if(is_null($arrayc))
  {
    $errors['branch']='Branch ID invalid';
  }

  $Accountname=mysqli_real_escape_string($conn,$_GET['Account_name']);
  $balance=mysqli_real_escape_string($conn,$_GET['balance']);
  $sql="INSERT INTO `savings_accounts`(`userid`,`balance`, `account_name`,`branch_id`) VALUES ('$userid','$balance','$Accountname','$branch')";
  //print_r($acc_number);
  //echo htmlspecialchars($sql);
  if(mysqli_query($conn,$sql))
  {  
    $msg="Account created successfully. \nYour account number is "; 
  }
  else 
  {
    echo ("error").mysqli_error($conn);
  }
  $sql1="SELECT s_account_number FROM `savings_accounts` ORDER BY created_on DESC LIMIT 1";
  $k=mysqli_query($conn,$sql1);
  $acc_number=mysqli_fetch_array($k,MYSQLI_ASSOC);
  $qaz=$acc_number['s_account_number'];
  $sql2 = "INSERT INTO `savings_transactions`(`account_number`,`amount_`, `description`, `balance`) VALUES ('$qaz','$balance','$balance opening balance ','$balance')";
  $l=mysqli_query($conn,$sql2);
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
       <a href="create_new_acc.php?userid=<?php echo($userid);?>&password=<?php echo($password);?>" class="brand-logo brand-text">Back</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li>
  	</ul>
    </div>
  </nav>

<div class="container"><h3 class="center">Create a Savings Account</h3>
  <h4><?php echo htmlspecialchars($msg);
  echo htmlspecialchars($acc_number['s_account_number']);
  ?>
<div class="container">
  <div class="container">
  <form class="white" action="savings.php" method="GET">
    <input type="hidden" name="password" value='<?php echo($password) ?>'>
  <input type="hidden" name="userid" value='<?php echo($userid) ?>'>
    <label style="color:grey;font-size: 18px;">Account name</label>
    <input type="text" name="Account_name" value='<?php echo($Accountname) ?>' required>
    <label style="color:grey;font-size: 18px;">Opening balance</label>
    <input type="number" name="balance" value='<?php echo($balance) ?>' required min='500'>
    <label style="color:grey;font-size: 18px;">Branch ID</label>
    <input type="number" name="branch" value='<?php echo($branch) ?>' required >
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