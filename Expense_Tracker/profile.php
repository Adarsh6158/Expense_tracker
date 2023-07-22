<?php
include './Includes/Functions/functions.php';
include './Includes/Functions/auth.php';
$user_id = $_SESSION['user']['id'];


$userInfo = get_info("users", $user_id);
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
			<strong>Update Profile</strong></h4>
		    
		</div>
		<div class="row justify-content-center">
		    <div class="col-lg-12 mx-auto mbr-form form-col md-pb">
                        <div class="form-wrap" data-form-type="formoid">
                            <form action="process_update_profile.php" method="POST" class="mbr-form form-with-styler col-lg-6 mx-auto" data-form-title="Form Name">
				
                                <div class="dragArea form-row">
				    <div class="col-sm-12 form-group">
					<label >Username</label>
                                        <input type="text" name="user[username]" placeholder="Username" value="<?=$userInfo['username']?>" class="form-control display-7" required="required" />
                                    </div>
				    
				    <div style="clear: both"></div><br/>
				    <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password">
					<label >New Password</label>
					<input type="password" name="user[password]" placeholder="New Password" data-form-field="password" class="form-control display-7" value="" id="password-formbuilder-1o">
				    </div>
				    <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="password1">
					<label >Confirm Password</label>
					<input type="password" name="user[confirm_password]" placeholder="Confirm Password" data-form-field="password" class="form-control display-7" value="" id="password1-formbuilder-1o">
				    </div>
				    <div style="clear: both"></div><br/>
				    
                                    <div class="mbr-section-btn">
					<button style="display: inline-block;" type="submit" class="btn btn-sm btn-secondary display-7">Save</button>
				    </div>
				    
                                </div>
                            </form>
                        </div>
                    </div>
		</div>
	    </div>
	</section>

	
	

	<?php include './bottom_scripts.php'; ?>
	<script>
	    $(document).ready(function(){
		
	    });
	</script>


    </body>
</html>