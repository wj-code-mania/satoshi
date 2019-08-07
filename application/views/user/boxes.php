						<div class="col-sm-8 panel-body-right">	
							<?php if($last_boxes){?>
							<div class="xe-widget xe-counter-block" data-count=".num" data-from="0" data-to="99.9" data-suffix="%" data-duration="2">
								<div class="xe-upper">
									
									<div class="xe-icon">
										<i class="linecons-cloud"></i>
									</div>
									<div class="xe-label">
										<strong>
										You have uploaded some files from this computer.</strong><span> Do you wish to assign these boxes to this account?
										</span>
									</div>
									
								</div>
								<?php
								foreach($last_boxes as $box){?>
									<div class="xe-lower">
										<?php 
											$attributes = array("method"=>"POST","role"=>"form");
											$hidden = array('id' => $box->id);
											echo form_open('user/importBox', $attributes,$hidden);
										?>
										<div class="border"></div>
										<span><h3>BOX : <?php echo strtoupper($box->box_name);?></h3></span>
										<strong><?php echo time_ago_in_words(human_to_unix($box->reg_time));?> ago</strong>
										<br/>
										<button id="btnImport" class="btn btn-primary">
											<span>Import to this account</span>
										</button>
										<?php echo form_close();?>
									</div>
								<?php }?>
							</div>
							<?php }?>
						<div class="col-sm-12 mailbox-right">	
							<div class="mail-compose">
								<div class="mail-header">
									<div class="row">
										<div class="col-sm-6">
											<H3>Your boxes</H3>
										</div>
										<div class="col-sm-6">
											<?php echo anchor("/","<i class='fa fa-plus'></i>",'class="btn btn-white btn-icon btn-add-box pull-right" id = "box_add"');?>
										</div>
									</div>
								</div>
								<?php if($boxes){?>
								<div class="col-md-12">
									<?php foreach($boxes as $box){?>
									<div class='row alert alert-info' style="display: flex;">
										<div class='col-sm-10' style="margin: auto;">
											<?php echo anchor(site_url($box->box_name),strtoupper($box->box_name));?>
										</div>
										<div class='col-sm-2' style="margin: auto; text-align: right;">
											<?php echo anchor('box/boxedit/'.$box->id, 'edit', array('class' => 'btn btn-circle btn-primary'));?>
										</div>
									</div>
									<?php }?>
								</div>
								<?php }?>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			</div>