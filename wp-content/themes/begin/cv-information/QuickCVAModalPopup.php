  
<?php
   if( $_GET["name"] == 'name' ) {
      //echo "Welcome ". $_GET['name']. "<br />";
     /// echo "You are ". $_GET['age']. " years old.";
      
    

 include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Example of Auto Loading Bootstrap Modal on Page Load</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
</head>
<body>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">SkillBeyondBoundaries.com</h4>
				<h6 class="modal-title">Quick CVA: Input Sheet </h6>
            </div>
            <div class="modal-body">
				   <table id="example2" class="table table-bordered table-hover">
                

         <?php
         
         $sql = 'SELECT * FROM quick_cv ORDER BY  id DESC LIMIT 1';
		
         $result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
				?>
				  <tr>
						<th>Planned recruitments for a year through third parties (number of hires)</th>
						 <td><?php echo $row['recruitments_third_parties']; ?></td>
				</tr>
				 <tr>
					<th>Planned recruitments for a year through employee referrals (number of hires)</th>
					<td><?php echo $row['QuickCVA_planned_recruitments']; ?></td>
				</tr>
				<tr>
					  <th>Average Cost-To-Company (CTC) per hire per annum in reporting currency</th>
				 <td><?php echo $row['QuickCVA_Average_cost']; ?></td>
				</tr>
				
				<tr>
					 <th>Average recruitment charges (as % of CTC)</th>
			      <td><?php echo $row['QuickCVA_Average_recruitment']; ?></td>
				</tr>
				<tr>
					  <th>Average referral fees paid to employees per hire in reporting currency</th>
			           <td><?php echo $row['QuickCVA_average_referral_fees_paid']; ?></td>
				</tr>
				
					<tr>
					 <th>Annual average bench (from within the total employees) in numbers</th>
			           <td><?php echo $row['QuickCVA_Annual_bench_employees']; ?></td>
				</tr>
				<tr>
					 <th>Average overheads (equipment, rent, utilities etc.) per employee in reporting currency</th>
			           <td><?php echo $row['QuickCVA_Average_overheads']; ?></td>
				</tr>
				
				
				<tr>
					<th>Your desired mark-up (%) on employees that you would lend out</th>
			          <td><?php echo $row['QuickCVA_desired_markup']; ?></td>
				</tr>
				
					<tr>
					 <th>Current Cost Of Above In Reporting Currency</th>
			         <td><?php echo $row['QuickCVA_Annual_bench']; ?></td>
				</tr>				
				
				<?php
            }
			
         } 
		 else {
            echo "0 results";
         }
         mysqli_close($conn);
      ?>
     
        <div class="control-sidebar-bg"></div>
    </thead>
              </section>
             </table>
			  <h4>Submitted Successfully</h4>
			 <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true">OK</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
  }
?> 
