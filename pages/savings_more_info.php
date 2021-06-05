<?php 
include ('templates/database_conn.php');

if(isset($_GET['userid'])){
$id=mysqli_real_escape_string($conn,$_GET['userid']);
$userid=$id;
$password=mysqli_real_escape_string($conn,$_GET['password']);
$account=mysqli_real_escape_string($conn,$_GET['s_account_number']);

$sql4 = "select * from customers where userid = '$userid' and password = '$password'";
    $auresult = mysqli_query($conn, $sql4);  
    $row = mysqli_fetch_array($auresult, MYSQLI_ASSOC);
     if(is_null($row))
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
//print_r($accountinfo);
mysqli_free_result($res);
$date=date("Y-m-d");
$sql6="UPDATE `issued_cheques` SET `status`=2 WHERE `date_of_claim`<='$date' and `status`=1";
mysqli_query($conn,$sql6);
$sql1="SELECT * from savings_transactions where account_number=$account order by timestamp_ desc";

$result1= mysqli_query($conn,$sql1);
$transaction1=mysqli_fetch_all($result1,MYSQLI_ASSOC);
mysqli_free_result($result1);

mysqli_close($conn);
//print_r($transaction1);
}
 ?>

<!DOCTYPE html>
<html>
 <head>
  <title>BANK WEBSITE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style type="text/css">
    .brand{
      background:#000000 !important;
    }
    .brand-text{
      color: #808080 !important;
    }
    form{
      max-width: 700px;
      margin: 40px;
      padding: 20px;
    }
  </style>
</head>
<body class="grey lighten-4" >
  <nav class="white z-depth-0">

    <div class ="container">
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li>
    </ul>
      <a href="index.php?userid=<?php echo($id);?>&password=<?php echo($password);?>" class="brand-logo brand-text">BANK</a>
      
    </div>
  </nav>
<style type="text/css">
.h4{

	margin-left:75px;
	margin-right:75px;	
}
</style>
	
<h4 class='center'>Transaction Details: <?php echo htmlspecialchars($accountinfo['account_name']);?>(<?php echo htmlspecialchars($accountinfo['s_account_number']); ?>)	</h4>
  <div class="center">
  <a href="savings_trans.php?userid=<?php echo($id);?>&password=<?php echo($password);?>&s_account_number=<?php echo ($account) ?>" class="btn brand z-depth-0">Funds Transfer</a>
  <a href="savings_issue_check.php?userid=<?php echo($id);?>&password=<?php echo($password);?>&s_account_number=<?php echo ($account) ?>" class="btn brand z-depth-0">Issue Cheque</a>
  <p>
  <?php
       include ('templates/database_conn.php');
       $sql5="Select * from `issued_cheques` where `reciever_ac_no` ='$account' and `status`=2";
       $res5=mysqli_query($conn,$sql5);
       $count=mysqli_num_rows($res5);  
  ?>
  </p>
  <p>
      <a href="savings_view_all_cheques.php?userid=<?php echo($id);?>&password=<?php echo($password);?>&s_account_number=<?php echo ($account) ?>" class="btn brand z-depth-0">Claim Cheque:<?php echo $count;?></a>
  </p>
</div>
</head>
<body class="grey lighten-4" >
	<div class='container'>
  	<div class='row'>
  		<?php foreach($transaction1 as $trans){ ?>

  			<div class="col s12 md6">
  				<div class="card z-depth-0">
            <div class="card-content left">
              <h5>Transaction ID: <?php echo htmlspecialchars($trans['trans_id']); ?></h5>
              <h6>Time: <?php echo htmlspecialchars($trans['timestamp_']);?></h6>
              </div>
  					<div class='card-content center'>
  						<h5>Balance: <?php echo htmlspecialchars($trans['balance']);?> INR</h5>
  						<h6>Description: <?php echo htmlspecialchars($trans['description']); ?></h6>
  			            </div>
                          
        
  					
  					</div>
  				</div>

  		 <?php } ?>
  	</div>		
  </div>

<?php include('templates/footer.php') ?>
</html>