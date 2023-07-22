<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

// Perform the query
$sql = "SELECT BUDGET.AMOUNT_ID AS BUDGET, EXPENSES.AMOUNT_PID AS EXPENSE, (BUDGET.AMOUNT_ID-EXPENSES.AMOUNT_PID) AS DEBT, EXPENSES.DESCRIPTION AS DESCRIPTION
        FROM BUDGET, EXPENSES
        WHERE BUDGET.GOAL_ID=EXPENSES.DESCRIPTION AND BUDGET.user_id = $user_id";
$result = mysqli_query($db, $sql);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result as an associative array
$debt = array();
while ($row = mysqli_fetch_assoc($result)) {
    $debt[] = $row;
}
?><!DOCTYPE html>
<html  >
    <head>

	<?php include './top_scripts.php'; ?>
    </head>
    <body>

	<?php include './Includes/header.php'; ?>


	<section class="features7 cid-sENIyiRsb8" id="features08-3" style="min-height: 500px;">


	    <div class="container">
		<div class="mbr-section-head pb-5">
		    <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
			<strong>MANAGE DEBT</strong></h4>
		    
		</div>
		<div class="row ">
		    
		    <?php
		    if(!empty($debt)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
					<th>DESCRIPTION</th>
					<th>BUDGET</th>
					<th>EXPENSE</th>
				    <th>DEBT</th>
					

				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($debt as $deb){
				?><tr>
				    <td><?=$deb['DESCRIPTION']?></td>
					<td><?=$deb['BUDGET']?></td>
				    <td><?=$deb['EXPENSE']?></td>
					<td><?=$deb['DEBT']?></td>
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No DEBT yet</h4><?php
		    }
		    ?>
	</section>
	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>


    </body>
</html>
<!-- SET @autoid:=0;
update budget set id=@autoid:= @autoid+1;
alter table budget AUTO_INCREMENT=1; -->