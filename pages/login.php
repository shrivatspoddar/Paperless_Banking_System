<?php 

include('templates/database_conn.php');

$userid=$password='';
$errors =array('userid'=>' ','password'=>'');

if(isset($_POST['submit']))
{

IF(empty($_POST['userid'])){
		$errors['userid'] = 'USER-ID cant be empty';}
		else{
			$errors['userid']='';
			$userid=$_POST['userid'];
			if(!preg_match('/^[0-9\s]+$/', $userid)){
				$errors['userid']='User ID is Invalid';
			}
		}

IF(empty($_POST['password'])){
		$errors['password'] = 'PASSWORD can not be empty';}
		else{
			$password=$_POST['password'];
			}
		}

if(array_filter($errors)){
		//echo errors;
	}

else{

     $userid= mysqli_real_escape_string($conn,$_POST['userid']);
     $password= mysqli_real_escape_string($conn,$_POST['password']);

     $sql = "select * from customers where userid = '$userid' and password = '$password'";  

     $result = mysqli_query($conn, $sql);  
     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

     if(is_null($row))
     {
     	$errors['userid'] = 'Incorrect Credentials';
     }

     else
     {
     	if (array_filter($errors))
     	{
   			 
     	}
     	else
     	{
     		header("Location: index.php?userid=$userid&password=$password");
     	}


     }

}



?>



<!DOCTYPE html>
<html>
  <head>
	<title center>Banking Portal</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style type="text/css">
		.brand{
			background:#000000;
		}
		.brand-text{
			color: #808080;
		}
		form{
			max-width: 800px;
			margin: 100px;
			padding: 20px;
		}
	</style>
 </head>
<body class="grey lighten-4" >
	<nav class="white z-depth-0">
		<div class ="container">
			<a href='#' class="brand-logo brand-text">BANK</a>
			<ul id="nav-mobile" class="right">
				<li><a href="sign_up.php" target="_blank" class="btn brand z-depth-0">Sign Up</a></li>
			</ul>
		</div>
	</nav>
	<section class="container grey-text" >
  	   	<h4 class="center">LOGIN</h4>

  	<form class="white" action="login.php" method="POST">
  		
  		<label>User ID</label>
  		<input type="text" name="userid" value='<?php echo htmlspecialchars ($userid) ?>'>
		<div class="red-text"> <?php echo htmlspecialchars( $errors['userid'] )?> </div>

  		<label>Password</label>
  		<input type="password" name="password" value='<?php echo htmlspecialchars ($password) ?>'>
  		<div class="red-text"><?php echo htmlspecialchars( $errors['password']) ?></div>

  		<div class="center">
  			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
  		</div>
  	</form>
	</section>

 <footer class="section">
 	<h6 class=" center black-text">For Testing Purposes Only</h6>
</footer>
</body>
