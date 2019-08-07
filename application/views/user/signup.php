<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title>Sign UP | Private Zone</title>
	
	<!--link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic"-->
	<?php
		echo link_tag('assets/global/css/fonts/linecons/css/linecons.css');
        echo link_tag('assets/global/css/fonts/fontawesome/css/font-awesome.min.css');
		echo link_tag('assets/global/plugins/bootstrap/css/bootstrap.min.css');
	
		echo link_tag('assets/global/css/xenon-core.css');
        echo link_tag('assets/global/css/xenon-forms.css');
		echo link_tag('assets/global/css/xenon-components.css');
		echo link_tag('assets/global/css/xenon-skins.css');
		echo link_tag('assets/global/css/xenon-skins.css');
		echo link_tag('assets/pages/css/style.css');
		
		
		echo $this->javascript->external('assets/global/scripts/jquery-1.11.1.min.js',false);
		echo $this->javascript->external('assets/global/scripts/jquery-migrate.min.js',false);
		echo $this->javascript->external('assets/global/plugins/jquery-validation/js/jquery.validate.min.js',false);
		
		
		echo $this->javascript->external('assets/global/plugins/bootstrap/js/bootstrap.min.js',false);
		//echo $this->javascript->external('assets/global/scripts/app.min.js',false);
		echo $this->javascript->external('assets/global/scripts/resizeable.js',false);
		
	?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<?php
		echo $this->javascript->external('assets/global/scripts/html5shiv.min.js',false);
		echo $this->javascript->external('assets/global/scripts/respond.min.js',false);
	?>
	<!-- [endif] -->
	<script>
		var base_url = "<?php echo base_url();?>";
	</script>
	
</head>
<body class="page-body login-page login-light">
	<div class="login-container">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<!-- Errors container -->
				<div class="errors-container">
				</div>
				<!-- Add class "fade-in-effect" for login form effect -->
				<form method="post" role="form" id="login" class="login-form fade-in-effect">
					<div class="login-header">
						<?php echo anchor("/","<h1 class='title'><i class='fa fa-btc'></i> ".SITE_TITLE."</h1>",'class="logo"');?>
						<p id="flush_message"></p>
					</div>
					<div class="form-group">
						<label class="control-label" for="email">Email</label>
						<input type="text" class="form-control" name="email" id="email" autocomplete="off" />
					</div>
					<div class="form-group">
						<label class="control-label" for="user_name">User Name</label>
						<input type="text" class="form-control" name="user_name" id="user_name" autocomplete="off" />
					</div>
					<div class="form-group">
						<label class="control-label" for="passwd">Password</label>
						<input type="password" class="form-control" name="passwd" id="passwd" autocomplete="off" />
					</div>
					<div class="form-group">
						<label class="control-label" for="repeat_passwd">Repeat Password</label>
						<input type="password" class="form-control" name="repeat_passwd" id="repeat_passwd" autocomplete="off" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary  btn-block text-left">
							<i class="fa-lock"></i>
							Sign Up
						</button>
					</div>
					<div class="form-group">
						<?php 
							echo anchor("user/signin",'<i class="fa-lock"></i> Sign In','class="btn btn-primary  btn-block text-left"');
						?>
					</div>
					<div class="login-footer">
					</div>
				</form>
			</div>
			<div class="col-sm-3"></div>
		</div>
	</div>

	<div class="modal fade" id="modal-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" style="color: #000;">Please check your Email box.</h4>
				</div>
				
				<div class="modal-footer">
					<button id="btn_confirm" type="submit" class="btn btn-info" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

	<!-- JavaScripts initializations and stuff -->
	<?php 
		echo $this->javascript->external('assets/global/scripts/TweenMax.min.js',false);
		echo $this->javascript->external('assets/global/scripts/joinable.js',false);
		echo $this->javascript->external('assets/global/scripts/xenon-api.js',false);
		echo $this->javascript->external('assets/global/scripts/xenon-toggles.js',false);
		echo $this->javascript->external('assets/global/plugins/toastr/toastr.min.js',false);
		echo $this->javascript->external('assets/global/scripts/xenon-custom.js',false);
		echo $this->javascript->external('assets/pages/scripts/user_signup.js',false);
	?>

</body>
</html>