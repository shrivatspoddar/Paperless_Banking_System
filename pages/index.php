<?php
include ('templates/database_conn.php');
if(isset($_GET['userid']))
{
  $userid=mysqli_real_escape_string($conn,$_GET['userid']);
  $password= mysqli_real_escape_string($conn,$_GET['password']);
  $sql = "select * from customers where userid = '$userid' and password = '$password'";
  $auresult = mysqli_query($conn, $sql);  
  $row = mysqli_fetch_array($auresult, MYSQLI_ASSOC);
   if(is_null($row))
   {
    header("Location: login.php");
   }
  
  $sql1="SELECT * from savings_accounts where userid='$userid'";
  $result = mysqli_query($conn,$sql1);
  $accounts=mysqli_fetch_all($result, MYSQLI_ASSOC);

  $sql2="SELECT * from current_account where user_id='$userid'";
  $result2 = mysqli_query($conn,$sql2);
  $accounts2=mysqli_fetch_all($result2, MYSQLI_ASSOC);

  $sql3="SELECT * from loan_accounts where user_id='$userid'";
  $result3 = mysqli_query($conn,$sql3);
  $accounts3=mysqli_fetch_all($result3, MYSQLI_ASSOC);

  $sql4="SELECT * from fixed_deposits where user_id='$userid'";
  $result4 = mysqli_query($conn,$sql4);
  $accounts4=mysqli_fetch_all($result4, MYSQLI_ASSOC);

 $sql5="SELECT branch_mgr_contact from branch where branch_id in (select branch_id from customers where userid=$userid)";
  $result5 = mysqli_query($conn,$sql5);
  $accounts5=mysqli_fetch_array($result5, MYSQLI_ASSOC);
  //print_r($accounts5);
}
else{
  header("Location: login.php");
}

mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_free_result($result4);


mysqli_close($conn);

//print_r($customers);

 ?>

<!DOCTYPE html>
<html>

  <head>
  <title>BANK</title>
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
      <a href="#" class="brand-logo brand-text">BANK</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
        <li><a href="create_new_acc.php?userid=<?php echo htmlspecialchars($userid);?>&password=<?php echo htmlspecialchars($password);?>" class="btn brand z-depth-0">Create a new account</a></li>
        <li><a href="login.php" class="btn brand z-depth-0">Sign Out</a></li>
      </ul>
    </div>
  </nav>
  <div>
      <p class="center"> User ID: <?php echo htmlspecialchars($userid) ?></p>
  </div>
  <div class="container"><h4>Welcome <?php echo htmlspecialchars($row['customer_name']) ?>, </h4>
  <h3 class='center'>Your Accounts</h3>
  

  <div class='container'>
  	<div class='row'>
  		<?php foreach($accounts as $account){ ?>

  			<div class="col s12 md6">
  				<div class="card z-depth-0">
            <div class="card-content left">
              <h5><?php echo htmlspecialchars($account['account_name']); ?></h5>
              <div><h6>Account Number: <?php echo htmlspecialchars($account['s_account_number']); ?></h6></div>
            </div>
  					<div class='card-content center'>
  						<h5>Balance: <?php echo htmlspecialchars($account['balance']);?> INR</h5>
  						<div>
               -----------------     
              </div>
              </div>
              <div class='card-action right-align'>
                <a class="brand-text" target=blank_ href='savings_more_info.php?userid=<?php echo($account['userid'])?>&password=<?php echo($password);?>&s_account_number=<?php echo $account['s_account_number'] ?>'>More Info</a>
                
              </div>
  					
  					</div>
  				</div>

  		 <?php } ?>
  	</div>		
  </div>

    <div class='container'>
    <div class='row'>
      <?php foreach($accounts2 as $account2){ ?>

        <div class="col s12 md6">
          <div class="card z-depth-0">
            <div class="card-content left">
              <h4><?php echo htmlspecialchars($account2['account_name']); ?></h4>
              <div><h6>Account number: <?php echo htmlspecialchars($account2['c_account_number']); ?></h6></div>
            </div>
            <div class='card-content center'>
              <h4>Balance: <?php echo htmlspecialchars($account2['balance']);?> INR</h4>
              <div>
               <h6>company name: <?php echo ($account2['company_name']); ?></h6>     
              </div>
              </div>
              <div class='card-action right-align'>
                <a class="brand-text" target= blank_ href="current_more_info.php?userid=<?php echo($userid)?>&password=<?php echo($password);?>&c_account_number=<?php echo $account2['c_account_number'] ?>">Transactions Info</a>
                
              </div>
            
            </div>
          </div>

       <?php } ?>
    </div>    
  </div>

  <div class='container'>
    <div class='row'>
      <?php foreach($accounts3 as $account3){ ?>

        <div class="col s12 md6">
          <div class="card z-depth-0">
            <div class="card-content left">
              <h4><?php echo htmlspecialchars($account3['account_name']); ?></h4>
              <div><h6>Account number: <?php echo htmlspecialchars($account3['loan_account_number']); ?></h6></div>
            </div>
            <div class='card-content center'>
              <h4>Amount: <?php echo htmlspecialchars($account3['amount']);?> INR</h4>
              <div>
               ------------------      
              </div>
              </div>
              <div class='card-action right-align'>
                <a class="brand-text" target= blank_ href="loan_more_info.php?userid=<?php echo($userid)?>&password=<?php echo($password);?>&loan_account_number=<?php echo $account3['loan_account_number'] ?>">Transactions Info</a>
              
            </div>
            </div>
          </div>

       <?php } ?>
    </div>    
  </div>

  <div class='container'>
    <div class='row'>
      <?php foreach($accounts4 as $account4){ ?>

        <div class="col s12 md6">
          <div class="card z-depth-0">
            <div class="card-content left">
              <h4><?php echo htmlspecialchars($account4['account_name']); ?></h4>
              <div><h6>Account number: <?php echo htmlspecialchars($account4['fd_account_number']); ?></h6></div>
            </div>
            <div class='card-content center'>
              <h4>Amount: <?php echo htmlspecialchars($account4['final_amount']);?> INR</h4>
              <div>
               ------------------      
              </div>
            </div>
            <div class='card-action right-align'>
                <?php echo htmlspecialchars($account4['bond_duration'] );?> years
              </div>
              <div class="card-action right-align">
                Created on :<?php echo htmlspecialchars($account4['created_on']); ?>
              </div>
            </div>
          </div>
          </div>

       <?php } ?>
    </div>    
  </div>

  <?php include ('templates/footer.php') ?>

</html>