<?php 
include ('templates/database_conn.php');
$countxx =1;
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
       $sql5="Select * from `issued_cheques` where `reciever_ac_no` ='$account' and `status`=2";
       $res5=mysqli_query($conn,$sql5);
       $row=mysqli_fetch_all($res5,MYSQLI_ASSOC);

}
else{
    header("location : login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheques digital view</title>
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
    .rounded{
        border-radius: 25px;
        background: white;
        border: 2px solid #73AD21;
        padding: 20px;
        width: 100%;
        height: 100%;
    }
    .box{
        border-radius: 15px;
        background: white;
        border: 1px solid black;
        padding: 5px;
        width: 30%;
        height: 100%;
        float: right;
    }
    .clearfix{
      clear: both;
      float: none;
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
  <h2 class="center">Issued Cheques</h2>
	<div class='container'>
  	<div class='row'>
  		<?php foreach($row as $trans){ ?>

  			<div class="col s12 md6">
  				<div class="card z-depth-0">
                <div class="rounded">
                    <p>
                    <h5>Cheque: <?php echo $countxx;?></h5>
                    <h5 class="text right">Date: <?php echo $trans['date_of_claim'];?></h5>
                    <hr>
                    </p>
                    <p>
                        <h5><strong>Pay TO:</strong></h5>
                        <?php 
                            $acc=$accountinfo['userid'];
                            $sql="Select * from customers where userid ='$acc'";
                            $res2=mysqli_query($conn,$sql);
                            $ans=mysqli_fetch_array($res2,MYSQLI_ASSOC);
                            echo "<h5><u>".$ans["customer_name"]."</u></h5>"."<hr>";                            
                        ?>    
                    <div class="card content z-depth-0">
                            <h4 style = "float:left;">Amount</h4>
                            <h4 class="box">₹:<?php echo $trans['amount'];?>/-</h4>
                    </div>
                    <div class="clearfix"></div>
                    </p>
                    <hr><hr>
                    <h5 style="font-family: courier;"><?php
                    echo sprintf("%06d",$trans['cheque_id']);
                    echo "-";
                    echo "111222333";
                    echo  "-";
                    echo "XXXXXX";
                    echo "-";
                    echo "XX";
                    ?></h5>

                    <a href="savings_clcheque.php?cqid=<?php echo $trans['cheque_id'];?>&userid=<?php echo($userid);?>&password=<?php echo($password);?>&s_account_number=<?php echo($account);?>" class="right btn">Claim</a>

                </div>
  				</div>
  			</div>

  		 <?php $countxx++;
        } ?>
  	</div>		
  </div>

<?php include('templates/footer.php') ?>
</html>