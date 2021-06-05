<?php $conn = mysqli_connect('localhost','root','','bank');

if(!$conn){
	 echo 'connection error: ' . mysqli_connect_error();
}
?>