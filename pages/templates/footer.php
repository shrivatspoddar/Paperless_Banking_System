<?php
include "templates/database_conn.php";
 $sql5="SELECT branch_mgr_contact from branch where branch_id in (select branch_id from customers where userid=$userid)";
  $result5 = mysqli_query($conn,$sql5);
  $accounts5=mysqli_fetch_array($result5, MYSQLI_ASSOC);
   ?>

   <footer class="section">
   	<div class ="container">
   	<h6 class="center black-text">Reach your Bank Manager at: <?php echo htmlspecialchars($accounts5['branch_mgr_contact']); ?> for any queries.</h6>
	<p class=" center black-text">For Testing Purposes only</p>
</div>
</footer>
</body>