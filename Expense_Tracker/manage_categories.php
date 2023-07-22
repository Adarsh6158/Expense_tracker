<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];

// Perform the query
$sql = "SELECT * FROM categories";
$result = mysqli_query($db, $sql);

// Fetch the categories as an associative array
$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
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
			<strong>MANAGE CATEGORIES</strong></h4>
		    
		</div>
		<div class="row ">
		    
		    <?php
		    if(!empty($categories)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
				    <th>ID</th>
				    <th>Name</th>
				    <th>Date Time</th>
				    <th>Edit</th>
				    <th>Delete</th>
				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($categories as $category){
				?><tr>
				    <td><?=$category['id']?></td>
				    <td><?=$category['name']?></td>
				    <td><?=date('Y-m-d H:i:s', strtotime($category['datetime_added']))?></td>
				    <td><a href="add_edit_category.php?category_id=<?=$category['id']?>" class="btn btn-sm btn-primary btn_extra_small">Edit</a></td>
				    <td><a onclick="return confirm('Are you sure you want to delete this category? ALL EXPENSES UNDER THIS CATEGORY WILL BE DELETED')" href="delete_category.php?category_id=<?=$category['id']?>" class="btn btn-sm btn-primary btn_extra_small">Delete</a></td>
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No categories added yet</h4><?php
		    }
		    ?>
		    
		</div>
		<a href="add_edit_category.php" class="btn btn-primary">Add Category</a>
	    </div>
	</section>
	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>


    </body>
</html>