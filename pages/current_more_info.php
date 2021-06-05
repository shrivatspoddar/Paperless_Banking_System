<?php 
include ('templates/database_conn.php');

if(isset($_GET['userid'])){

$id=mysqli_real_escape_string($conn,$_GET['userid']);
$userid=$id;
$password=mysqli_real_escape_string($conn,$_GET['password']);
$account=mysqli_real_escape_string($conn,$_GET['c_account_number']);

$sql="select * from current_account where c_account_number=$account";
$res=mysqli_query($conn,$sql);
$accountinfo=mysqli_fetch_array($res,MYSQLI_ASSOC);
//print_r($accountinfo);
mysqli_free_result($res);


$sql1="SELECT * from current_transactions where account_number=$account order by timestamp desc";

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
    <a href="index.php?userid=<?php echo($id);?>&password=<?php echo($password);?>" class="brand-logo brand-text">Click to go back</a>
      
    </div>
  </nav>
<style type="text/css">
.h4{

	margin-left:75px;
	margin-right:75px;	
}
</style>
	
<h4 class='center'>TRANSACTION INFORMATION FOR <?php echo htmlspecialchars($accountinfo['account_name']);?>(<?php echo htmlspecialchars($accountinfo['c_account_number']); ?>)	</h4>
<div class="center">
  <a href="current_trans.php?userid=<?php echo($id);?>&password=<?php echo($password);?>&c_account_number=<?php echo $account; ?>" class="btn brand z-depth-0">Make transaction</a>
</div>
</head>
<body class="grey lighten-4" >
	<div class='container'>
  	<div class='row'>
  		<?php foreach($transaction1 as $trans){ ?>

  			<div class="col s12 md6">
  				<div class="card z-depth-0">
            <div class="card-content left">
              <h4>Transaction id: <?php echo htmlspecialchars($trans['trans_id']); ?></h4>
              <h6>time: <?php echo htmlspecialchars($trans['timestamp']);?></h6>
              </div>
  					<div class='card-content center'>
  						<h4>Spendable: <?php echo htmlspecialchars($trans['total_spendable']);?> INR</h4>
  						<h5>description: <?php echo htmlspecialchars($trans['transaction_description']); ?></h5>
  			            </div>
                          
        
  					
  					</div>
  				</div>

  		 <?php } ?>
  	</div>		
  </div>

<?php include('templates/footer.php') ?>
</html>