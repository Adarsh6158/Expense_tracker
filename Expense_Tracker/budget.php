<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

$sql = "SELECT * FROM budget WHERE user_id = $user_id";
$result = mysqli_query($db, $sql);

// Fetch the result as an associative array
$budget = array();
while ($row = mysqli_fetch_assoc($result)) {
    $budget[] = $row;
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
			<strong>MANAGE BUDGET</strong></h4>
		    
		</div>
		<div class="row ">
		    
		    <?php
		    if(!empty($budget)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
				    <th>ID</th>
				    <th>GOAL</th>
					<th>Amount</th>
				    <th>Date</th>
				    <th>Edit</th>
				    <th>Delete</th>
				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($budget as $bud){
				?><tr>
				    <td><?=$bud['id']?></td>
				    <td><?=$bud['goal_id']?></td>
					<td><?=$bud['amount_id']?></td>
				    <td><?=date('Y-m-d ', strtotime($bud['date']))?></td>
				    <td><a href="add_edit_budget.php?budget_id=<?=$bud['id']?>" class="btn btn-sm btn-primary btn_extra_small">Edit</a></td>
				    <td><a onclick="return confirm('Are you sure you want to delete this category? This source of income will be deleted')" href="delete_budget.php?budget_id=<?=$bud['id']?>" class="btn btn-sm btn-primary btn_extra_small">Delete</a></td>
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No BUDGET added yet</h4><?php
		    }
		    ?>
		    
		</div>
		<a href="add_edit_budget.php" class="btn btn-primary">Add BUDGET</a>
	    </div>
	</section>
	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>
    </body>
</html>
