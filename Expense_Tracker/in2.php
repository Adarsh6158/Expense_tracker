<!-- <?php
include './Includes/Functions/functions.php';
?><!DOCTYPE html>
<html  >
    <head>

	<?php include './top_scripts.php'; ?>
    </head>
    <body>

	<?php include './Includes/header.php'; ?>

	
    
    
	   
		</div>
		<div class="row">
		    <div class="col-lg-8 mx-auto mbr-form">
			<!--Formbuilder Form-->
			<form action="process_register.php" method="POST" class="mbr-form form-with-styler">
			    <div class="form-row">

				<div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">Oops...! some problem!</div>
			    </div>
			    <div class="dragArea form-row">
				<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="email">
				    <input type="text" name="user[username]" placeholder="Username" data-form-field="username" class="form-control display-7" value="" id="email-formbuilder-1o">
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password">
				    <input type="password" name="user[password]" placeholder="Password" data-form-field="password" class="form-control display-7" value="" id="password-formbuilder-1o">
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password1">
				    <input type="password" name="user[confirm_password]" placeholder="Confirm Password" data-form-field="password" class="form-control display-7" value="" id="password1-formbuilder-1o">
				</div>
				<div class="col-auto">
				    <button type="submit" class="btn btn-success display-7">Register Now</button>
				</div>
			    </div>
			</form>
		    </div>
		</div>
	    </div>
	</section>
	<?php include './bottom_scripts.php'; ?>



    </body>
</html>