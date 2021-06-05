<?php 
include ("templates/database_conn.php");

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
	$sql="select * from product_master";
	$result=mysqli_query($conn,$sql);
	$products=mysqli_fetch_all($result,MYSQLI_ASSOC);
	mysqli_free_result($result);
	//print_r($product);
}
$productname='';
if (isset($_GET['productname']))
{
	$productname=mysqli_real_escape_string($conn,$_GET['productname']);
}

 ?><!DOCTYPE html>
<html>
<head>
	<title>Create New Account</title>
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
      <a href="index.php?userid=<?php echo($userid);?>&password=<?php echo($password);?>" class="brand-logo brand-text">Click to go back</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li>
  	</ul>
    </div>
  </nav>
  <div class="container">
	<h4 class="center">Create New Account</h4>
	</div>
	<div class="container">
<div class="container">
<div class="container">
<form action="create_new_acc.php" method="GET" class="white">
	<input type="hidden" name="password" value='<?php echo($password) ?>'>
	<input type="hidden" name="userid" value='<?php echo($userid) ?>'>
  <label for="productno" style="color:black;font-size: 18px;">Type of account:
  <h4 style="color:red;font-size: 18px;"><?php echo($productname) ?>
  </h4></label>
  <select id="productno" name="productname" class="browser-default" onchange='if(this.value != 0) { this.form.submit(); }'>
    <option value="0">(Select Account Type)</option>
    <option value="savings">Savings</option>
    <option value="current">Current</option>
    <option value="loan">Loan</option>
	<option value="fixed deposit">Fixed deposit</option>
  </select>
  <div class="center">
	<!-- <input type="submit" class="btn brand z-depth-0"> -->
	<a href="<?php echo($productname)?>.php?userid=<?php echo($userid) ;?>&password=<?php echo($password); ?>"class="btn brand z-depth-0">Submit</a>
  </div>
</form>

</div>
</div>
</div>


</div>
</div>
</div>
		<div class="container">
  	    <div class="row">
		  <h4 class="center">Accounts Info</h4>
	<?php foreach($products as $product) { ?>

		<div class="col s12 md6">
  		  <div class="card z-depth-0">

            <div class="card">	
            	<div class="container" style="padding: 1px">
					<div><h5><?php echo($product['product_name']); ?></div></h5>
					<p><div><?php echo($product['description']); ?></div></p><br>
				</div>
			</div>
		   </div>
		</div>
	<?php } ?>

</div>
</div>

<?php include("templates/footer.php") ?>