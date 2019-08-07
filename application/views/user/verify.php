	<div class="page-error centered">
		
		<div class="error-symbol">
			<?php if ($state_verify == 1)	{?>
					<i class="fa-heart-o"></i>
					Success!
					</div>
		<?php	}else{ ?>
					<i class="fa-warning"></i>
					Unregistered Email!
					</div>
		<?php }?>
		
	</div>
	
	<div class="page-error-search centered">
		<?php echo anchor("user/signin",'<i class="fa-angle-left"></i> Go signin','class="go-back"');?>
	</div>

