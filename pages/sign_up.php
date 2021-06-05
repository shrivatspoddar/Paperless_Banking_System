<?php 
include('templates/database_conn.php');
$k=false;
include ('templates/check_errors_signup.php'); 

if (isset($_GET['submit']))
{
$branch=mysqli_real_escape_string($conn,$_GET['branch']);
$sqlc="select * from branch where branch_id=$branch";
$resc=mysqli_query($conn,$sqlc);
$arrayc=mysqli_fetch_array($resc,MYSQLI_ASSOC);
	if(is_null($arrayc))
	{
 	   $errors['branch']='Invalid Branch ID';
	}
}

if ($confirmpassword!=$password)
{
	$errors['confirmpassword']= "Password doesn't match ";
	$password=$confirmpassword='';}


	if(array_filter($errors)){
		//echo errors;
	}
	
else{
  $k=true;
  $name=mysqli_real_escape_string($conn,$_GET['name']);
  $DOB=mysqli_real_escape_string($conn,$_GET['DOB']);
  $address=mysqli_real_escape_string($conn,$_GET['address']);
  $email=mysqli_real_escape_string($conn,$_GET['email']);
  $password=mysqli_real_escape_string($conn,$_GET['password']);
  $phone=mysqli_real_escape_string($conn,$_GET['phone']);
  
  $sql="INSERT INTO `customers`(`password`, `customer_name`, `email`, `phone`, `address`, `date_of_birth`, `branch_id`) VALUES ('$password','$name','$email','$phone','$address','$DOB','$branch');";
  if(mysqli_query($conn,$sql)){
    $sql2="select * from customers where phone='$phone' and email='$email'";
    $result = mysqli_query($conn,$sql2);
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
	<title center>SIGN-UP</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.brand{
			background:#000000 !important;
		}
		.brand-text{
			color: #808080 !important;
		}
    .center
    {
      grid-auto-rows: auto;
    }
		form{
			max-width: 1200px;
			margin: 90px;
			padding: 20px;
		}
	</style>
</head>
<body class="grey lighten-4" >
	<nav class="white z-depth-0">
		<div class ="container">
			<a href="#" class="brand-logo brand-text">BANK</a>
      <ul id="nav-mobile" class="right">
        <li><a href="login.php" target="_blank" class="btn brand z-depth-0">Login</a></li>
      </ul>
		</div>
	</nav>

  
  <section class="container grey-text">
  	<h4 class="center">Create User</h4>
    <div class ="container">
      <h5 class="center" style="text-color: red;"><?php
      if($k)
      { 
      echo "Sign Up Successful \n";
      echo "User Id is ";
      echo htmlspecialchars($row['userid']);
      }
      else 
      {
         echo "User already exists";
      }
      ?> </h5>
    </div>
  	<form class="white" action="sign_up.php" method="GET">
      <div class="container">
  		<label  style="color:grey;font-size: 18px;">Name (All Caps)</label>
  		<input type="text" name="name" value='<?php echo htmlspecialchars($name) ?>'>
		  <div class="red-text"><?php echo htmlspecialchars( $errors['name'] )?></div>

  		<label style="color:grey;font-size: 18px;">Date of Birth</label>
  		<input type="date" name="DOB" value='<?php echo htmlspecialchars( $DOB) ?>'>
  		<div class="red-text"><?php echo htmlspecialchars( $errors['DOB']) ?></div>
  	
  		<label style="color:grey;font-size: 18px;">Address</label>
  		<input type="text" name="address" value='<?php echo htmlspecialchars( $address) ?>'>
  		<div class="red-text"><?php echo htmlspecialchars( $errors['address']) ?></div>


  		<label style="color:grey;font-size: 18px;">Email</label>
  		<input type="email" name="email" value=' <?php echo htmlspecialchars($email) ?>'>
  		<div class="red-text"><?php echo htmlspecialchars( $errors['email']) ?></div>


  		<label style="color:grey;font-size: 18px;">OTP(Email) <p style="text-color: red; font-size:10px;">For demo purpose, enter 0000</p></label>
  		<input type="text" name="OTP_MAIL" value='<?php echo htmlspecialchars( $OTP_MAIL) ?>'>
  		<div class="red-text"><?php echo htmlspecialchars( $errors['OTP_MAIL']) ?></div>


  		<label style="color:grey;font-size: 18px;">Mobile Number</label>
  		<input type="text" name="phone" value='<?php echo htmlspecialchars($phone)?>'>
  		<div class="red-text"><?php echo htmlspecialchars($errors['phone']) ?></div>


  		<label style="color:grey;font-size: 18px;">OTP(Phone)<p style="text-color: red; font-size:10px;">For demo purpose, enter 0000</p></label>
  		<input type="text" name="OTP_PHONE" value='<?php echo htmlspecialchars($OTP_PHONE)?>'>
  		<div class="red-text"><?php echo htmlspecialchars($errors['OTP_PHONE']) ?></div>

      <label style="color:grey;font-size: 18px;">Password</label>
  		<input type="password" name="password" value='<?php echo htmlspecialchars($password)?>'>
  		<div class="red-text"><?php echo htmlspecialchars($errors['password']) ?></div>

  		<label style="color:grey;font-size: 18px;">Confirm password</label>
  		<input type="password" name="confirmpassword" value='<?php echo htmlspecialchars($confirmpassword)?>'>
  		<div class="red-text"><?php echo htmlspecialchars($errors['confirmpassword']) ?></div>

      <label style="color:grey;font-size: 18px;">Branch ID</label>
      <input type="number" name="branch" value='<?php echo htmlspecialchars($branch)?>'>
      <div class="red-text"><?php echo htmlspecialchars($errors['branch']); ?></div>

  		<div class="center">
  			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
  		</div>
    </div>
  	</form>
  </section>
  
  
</html>

