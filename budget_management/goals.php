<!-- 
<?php
error_reporting(0);
$conn=mysqli_connect("localhost","root","","expense_tracker")or die(mysqli_error());
$sql3="SELECT username AS uname FROM USERS ";
$result3=mysqli_query($conn,$sql3);
while($row3=mysqli_fetch_assoc($result3)){
    $output4=$row3['uname'];
}
echo "USERNAME is=$output4<br>";


$sql1="SELECT SUM(amount_id) AS sum1 FROM BUDGET";
$result1=mysqli_query($conn,$sql1);
while($row1=mysqli_fetch_assoc($result1)){
    $output1=$row1['sum1'];
}
echo "Total budget is=$output1<br>";
// <br>
$sql2="SELECT SUM(amount_pid) as sum2 FROM EXPENSES ";
$result2=mysqli_query($conn,$sql2);
while($row2=mysqli_fetch_assoc($result2)){
    $output2=$row2['sum2'];
}

echo "Total expense is=$output2<br>";
$output3=$output2-$output1;
echo"Total debt is=$output3";

?>
</html> -->
<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];


$goals = $db->query("SELECT * FROM goals WHERE user_id = $user_id")->fetchAll();
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
			<strong>MANAGE GOALS</strong></h4>
		    
		</div>
		<div class="row ">
		    
		    <?php
		    if(!empty($goals)){
			?><table class="table table-bordered table-striped table-condensed">
			    <thead>
				<tr>
				    <th>ID</th>
				    <th>Goal</th>
				    <th>Date Time</th>
				    <th>Edit</th>
				    <th>Delete</th>
				</tr>
			    </thead>
			    <tbody>
			    <?php
			    foreach($goals as $gol){
				?><tr>
				    <td><?=$gol['id']?></td>
				    <td><?=$gol['goal']?></td>
				    <td><?=date('Y-m-d H:i:s', strtotime($gol['date']))?></td>
				    <td><a href="add_edit_goals.php?goal_id=<?=$gol['id']?>" class="btn btn-sm btn-primary btn_extra_small">Edit</a></td>
				    <td><a onclick="return confirm('Are you sure you want to delete this goal? ALL EXPENSES UNDER THIS GOAL WILL BE DELETED')" href="delete_goals.php?goal_id=<?=$gol['id']?>" class="btn btn-sm btn-primary btn_extra_small">Delete</a></td>
				</tr><?php
			    }
			    ?>
			    </tbody>
			</table><?php
		    }else{
			?><h4>No Goals added yet</h4><?php
		    }
		    ?>
		    
		</div>
		<a href="add_edit_goals.php" class="btn btn-primary">Add Goals</a>
	    </div>
	</section>
	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>


    </body>
</html>
