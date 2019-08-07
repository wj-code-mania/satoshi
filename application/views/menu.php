<div class="panel panel-default panel-main">				
	<!--div class="panel-heading">
		<h3 class="panel-title">
			<h3>Boxes
				<small class="description"></small>
			</h3>
		</h3>
	</div-->
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-4">
				<div class="list-menu-item">
				<?php
					if ($this->uri->rsegment(3,0) > 0) {
				?>
					<div class="col-sm-12 list-manage-box">
						<a class="list-toggle-container">
							<div class="list-toggle">
								<div class="list-toggle-title bold"> <i class='fa fa-suitcase'></i> Manage Box</div>
							</div>
						</a>
						<div class="task-list">
							<ul>
								<li class="task-list-item">
									<?php echo anchor('box/share_embed/'.$box_id, 'Share or embed');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('box/boxedit/'.$box_id, 'Box details');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('box/redirect_box/'.$box_id, 'Redirect box');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('box/sell_once_only/'.$box_id, 'Sell once only');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('box/delete_content/'.$box_id, 'Delete content');?>
								</li>
							</ul>
						</div>
					</div>
					
				<?php } ?>
					<div class="col-sm-12 list-your-account">
						<a class="list-toggle-container">
							<div class="list-toggle">
								<div class="list-toggle-title bold"> <i class='fa fa-user'></i> Your account</div>
							</div>
						</a>
						<div class="task-list">
							<ul>
								<li class="task-list-item">
									<?php echo anchor('user/boxes', 'Your boxes');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('user/withdrawal', 'Balance withdrawal');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('user/changepassword', 'Change your password');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('user/changeemail', 'Change contact email');?>
								</li>
								<li class="task-list-item">
									<?php echo anchor('user/signout', 'Sign Out');?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
						