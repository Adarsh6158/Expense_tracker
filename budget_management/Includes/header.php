<style>
	.navbar-caption{min-width:450px;
	font-size:39px;}
</style>
<section class="menu menu1 cid-sBOHoABUOH" once="menu" id="menu1-0">

	    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
		<div class="container">
		    <div class="navbar-brand">

			<span class="navbar-caption-wrap"><a class="navbar-caption text-info display-5" href="index.php">BUDGET MANAGEMENT&nbsp;</a></span>
		    </div>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<div class="hamburger">
			    <span></span>
			    <span></span>
			    <span></span>
			    <span></span>
			</div>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
			    
			    <?php
			    if(ss()){
				?><li class="nav-item"><a class="nav-link link text-warning display-7" href="index.php">Dashboard</a></li><?php
			    }
			    ?>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="manage_expenses.php">Expenses</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="manage_categories.php">Categories</a></li>
			    <li class="nav-item"><a class="nav-link link text-warning display-7" href="profile.php">My Profile</a></li>
			    <li class="nav-item"><a class="nav-link link text-warning display-7" href="income.php">Income</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="budget.php">Budget</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="goals.php">Goals</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="debt.php">Debt</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="date.php">Date Span</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="report.php">Report</a></li>
			    <?php
			    if(!ss()){
				?><li class="nav-item"><a class="nav-link link text-warning display-7" href="login.php">Login</a></li>
				<li class="nav-item"><a class="nav-link link text-warning display-7" href="register.php">Register</a></li><?php
			    }else{
				?><li class="nav-item"><a class="nav-link link text-warning display-7" href="logout.php">Logout</a></li><?php
			    }
			    ?>
			</ul>
		    </div>
		</div>
	    </nav>
	</section>
<?php
if(isset($_SESSION['SUCCESS'])){
    ?><p id="p_success"><?=$_SESSION['SUCCESS']?></p><?php
    unset($_SESSION['SUCCESS']);
}
?>
<?php
if(isset($_SESSION['ERROR'])){
    ?><p id="p_error" ><?=$_SESSION['ERROR']?></p><?php
    unset($_SESSION['ERROR']);
}
?>
<script>
    $('.nav-item.dropdown').on('mouseover', function(){
	$(this).find('.dropdown-menu').not('.dropdown-submenu').show();
    });
    
    $('.nav-item.dropdown').on('mouseout', function(){
	$(this).find('.dropdown-menu').not('.dropdown-submenu').hide();
    });
    
    
    
    $('.dropdown > .dropdown-item').on('mouseover', function(){
	$('.dropdown-submenu').hide();
	$(this).parent().find('.dropdown-submenu').show();
    });
    
//    $('div.dropdown').on('mouseout', function(){
//	$(this).find('.dropdown-submenu').hide();
//    });
    
    $('.nav-item.dropdown').on('click', function(e){
	$(this).find('.dropdown-menu').show();
	$(this).find('.dropdown-menu').css({
	   'height': 'auto',
	   'display': 'block',
	   'opacity': 1,
	   'visibility': 'visible'
	});
//	e.preventDefault();
	e.stopPropagation();
    });
</script>
