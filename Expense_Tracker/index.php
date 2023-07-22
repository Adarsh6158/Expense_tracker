<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];
$sql = "SELECT e.*, c.name as category_name FROM expenses e LEFT JOIN categories c ON e.category_id = c.id WHERE user_id = $user_id ORDER BY datetime_added DESC LIMIT 5";


// Perform the query
$result = mysqli_query($db, $sql);

// Fetch the results as an associative array
$recent_expenses = array();
while ($row = mysqli_fetch_assoc($result)) {
    $recent_expenses[] = $row;
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
			<strong>MY RECENT EXPENSES</strong></h4>
		    
		</div>
		<div class="row justify-content-center">
		    <?php
		    if(!empty($recent_expenses)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
				    <th>ID</th>
				    <th>Description</th>
				    <th>Amount</th>
				    <th>Category</th>
				    <th>Date Time</th>
				    <th>Edit</th>
				    <th>Delete</th>
				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($recent_expenses as $recent_expense){
				?><tr>
				    <td><?=$recent_expense['id']?></td>
				    <td><?=$recent_expense['description']?></td>
				    <td><?=$recent_expense['amount_pid']?></td>
				    <td><?=$recent_expense['category_name']?></td>
				    <td><?=date('Y-m-d H:i:s', strtotime($recent_expense['datetime_added']))?></td>
				    <td><a href="add_edit_expense.php?expense_id=<?=$recent_expense['id']?>" class="btn btn-sm btn-primary">Edit</a></td>
				    <td><a onclick="return confirm('Are you sure you want to delete this expense?')" href="delete_exepense.php?expense=<?=$recent_expense['id']?>" class="btn btn-sm btn-primary">Delete</a></td>
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No expenses added yet</h4><?php
		    }
		    ?>
		    
		</div>
		<a href="add_edit_expense.php" class="btn btn-primary">Add Expense</a>
	    </div>
	</section>

	
	
	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>


    </body>
</html>