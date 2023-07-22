<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];


$sql = "SELECT * FROM income WHERE user_id = $user_id";
$result = mysqli_query($db, $sql);

// Fetch the result as an associative array
$income = array();
while ($row = mysqli_fetch_assoc($result)) {
    $income[] = $row;
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
			<strong>MANAGE INCOME</strong></h4>
		    
		</div>
		<div class="row ">
		    
		    <?php
		    if(!empty($income)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
				    <th>ID</th>
				    <th>Source of Income</th>
					<th>Amount</th>
				    <th>Date</th>
				    <th>Edit</th>
				    <th>Delete</th>
				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($income as $inc){
				?><tr>
				    <td><?=$inc['id']?></td>
				    <td><?=$inc['name']?></td>
					<td><?=$inc['amount']?></td>
				    <td><?=date('Y-m-d ', strtotime($inc['date']))?></td>
				    <td><a href="add_edit_income.php?income_id=<?=$inc['id']?>" class="btn btn-sm btn-primary btn_extra_small">Edit</a></td>
				    <td><a onclick="return confirm('Are you sure you want to delete this category? This source of income will be deleted')" href="delete_income.php?income_id=<?=$inc['id']?>" class="btn btn-sm btn-primary btn_extra_small">Delete</a></td>
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No INCOME added yet</h4><?php
		    }
		    ?>
		    
		</div>
		<a href="add_edit_income.php" class="btn btn-primary">Add INCOME</a>
	    </div>
	</section>
	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>


    </body>
</html>