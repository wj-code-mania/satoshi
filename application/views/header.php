<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <title><?php echo SITE_TITLE;?></title>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="This project is to manage productions, materials and business for factory." name="description"/>
    <meta content="KSTAR" name="author"/>
    <meta name="MobileOptimized" content="320">
    <?php 
        echo link_tag('assets/global/css/fonts/linecons/css/linecons.css');
        echo link_tag('assets/global/css/fonts/fontawesome/css/font-awesome.min.css');
		
        echo link_tag('assets/global/plugins/bootstrap/css/bootstrap.min.css');
        echo link_tag('assets/global/plugins/msgbox/jquery.msgbox.css');
		//echo link_tag('assets/global/css/components.min.css');
        echo link_tag('assets/global/css/xenon-core.css');
        echo link_tag('assets/global/css/xenon-forms.css');
		echo link_tag('assets/global/css/xenon-components.css');
		//echo link_tag('assets/global/css/xenon-skins.css');
		
        echo link_tag('assets/pages/css/style.css');
		
    	foreach($styles as $style){
			echo link_tag($style);
		}
	?>   
    <?php
        echo $this->javascript->external('assets/global/scripts/jquery-1.11.1.min.js',false);
		echo $this->javascript->external('assets/global/scripts/jquery-migrate.min.js',false);
		echo $this->javascript->external('assets/global/scripts/jquery.blockui.min.js',false);
		
		echo $this->javascript->external('assets/global/plugins/bootstrap/js/bootstrap.min.js',false);
		echo $this->javascript->external('assets/global/scripts/jquery.form.min.js',false);
		echo $this->javascript->external('assets/global/plugins/msgbox/jquery.msgbox.js',false);
		
		
		echo $this->javascript->external('assets/global/scripts/app.min.js',false);
		echo $this->javascript->external('assets/global/scripts/resizeable.js',false);
		echo $this->javascript->external('assets/global/scripts/xenon-custom.js',false);
		foreach($scripts as $script){
			echo $this->javascript->external($script,false);
		}	
		echo link_tag('favicon.ico', 'shortcut icon', 'image/ico');
	?>
	<script>
		var base_url = "<?php echo base_url();?>";
	</script>
</head>
<body class="page-body">
	<div class="page-container">
	    <div class="main-content">
            <div class="page-title" style="display: flex;">
					<div class='col-md-2' style="margin: auto;">
						<div class="title-env">
							<?php echo anchor("/","<h1 class='title'><i class='fa fa-btc'></i> ".SITE_TITLE."</h1>");?>
						</div>
					</div>
					<div class='col-md-5'>
						
					</div>
					
					<div class='col-md-5'>
						<div class="header-link">
							<div class='breadcrumb'>
						<?php 
							if($this->session->has_userdata(SESSION_NAME)){
								$session =$this->session->userdata(SESSION_NAME);
								echo anchor('user/boxes', $session['user_name']);
								echo "&nbsp; / &nbsp;";
								echo anchor('user/signout', "Sign Out");
							}else{	
								echo anchor('user/signin', ' Sign In');?>
								&nbsp; / &nbsp;
								<?php echo anchor('user/signup', ' Sign Up');?>
							<?php 
							}
							?>
							&nbsp; / &nbsp;
							<?php echo anchor('bulletin/index', ' Sales bulletin board'); ?>
							</div>
						</div>
					</div>
			</div>