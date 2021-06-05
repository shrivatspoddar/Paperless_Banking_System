<?php
include ('templates/database_conn.php');

$name=$DOB=$address=$email=$password=$confirmpassword=$phone=$OTP_MAIL=$OTP_PHONE='';

$errors = array('name'=>'Required','DOB'=>'','address'=>'','email'=>'','OTP_MAIL'=>'','phone'=>'','OTP_PHONE'=>'','password'=>'','confirmpassword'=>'','branch'=>'');

$date="2003-01-01";

if(isset($_GET['submit']))
{
IF(empty($_GET['name'])){
		$errors['name'] = 'Name required';}
		else{
			$errors['name']='';
			$name=$_GET['name'];
		}

IF(empty($_GET['DOB'])){
		$errors['DOB']= 'DOB required';}
		else{
			$DOB=$_GET['DOB'];
			if(!($DOB < $date)){
				$errors['DOB']= 'Age can not be less than 18 ';}
		}


IF(empty($_GET['address'])){
		$errors['address']= 'Address required';}
		else $address=$_GET['address'];

IF(empty($_GET['email'])){
		$errors['email']= 'Email required';}
		else{
			$email=$_GET['email'];
		}

IF(empty($_GET['OTP_MAIL'])){
		$errors['OTP_MAIL']= 'OTP required';}
		else{
			$OTP_MAIL=$_GET['OTP_MAIL'];
			if($OTP_MAIL!='0000'){
				$errors['OTP_MAIL']= 'Incorrect OTP';
			}
		}

IF(empty($_GET['phone'])){
		$errors['phone']='Mobile Number required';}
		else{
			$phone=$_GET['phone'];
			if(!preg_match('/^\d{10}$/', $phone)){
				$errors['phone']='enter a valid 10 digit phone';
			}
		}

IF(empty($_GET['OTP_PHONE'])){
		$errors['OTP_PHONE']= 'OTP Required';}
		else{
			$OTP_PHONE=$_GET['OTP_PHONE'];
			if($OTP_PHONE!='0000'){
				$errors['OTP_PHONE']= 'INCORRECT OTP ';
			}
		}



IF(empty($_GET['password'])){
		$errors['password']= 'Password required';}
		else {$password=$_GET['password'];}


IF(empty($_GET['confirmpassword'])){
		$errors['confirmpassword']= 'Confirm password required';}
		else{$confirmpassword=$_GET['confirmpassword'];}

if(empty($_GET['branch'])){
	$errors['branch']='Branch ID required';}
	else{$branch=$_GET['branch'];}
}


