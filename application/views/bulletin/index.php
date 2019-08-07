
<section class="gallery-env">
			
				<div class="row">
				
					<!-- Gallery Album Optipns and Images -->
					<div class="col-sm-12 gallery-right">
						
						<!-- Album Header -->
						<div class="album-header">
							<h2>Bulletin</h2>
							
							<!--ul class="album-options list-unstyled list-inline">
								<li>
									<input type="checkbox" class="cbr" id="select-all" />
									<label for="select-all">Select all</label>
								</li>
								<li>
									<a href="#">
										<i class="fa-upload"></i>
										Add Images
									</a>
								</li>
								<li>
									<a href="#" data-action="sort">
										<i class="fa-arrows"></i>
										Re-order
									</a>
								</li>
								<li>
									<a href="#" data-action="edit">
										<i class="fa-edit"></i>
										Edit
									</a>
								</li>
								<li>
									<a href="#" data-action="trash">
										<i class="fa-trash"></i>
										Trash
									</a>
								</li>
							</ul-->
						</div>
						
						<!-- Sorting Information -->
						<div class="album-sorting-info">
							<div class="album-sorting-info-inner clearfix">
								<a href="#" class="btn btn-secondary btn-xs btn-single btn-icon btn-icon-standalone pull-right" data-action="sort">
									<i class="fa-save"></i>
									<span>Save Current Order</span>
								</a>
								
								<i class="fa-arrows-alt"></i>
								Drag images to sort them
							</div>
						</div>
						<?php if($boxes){?>
						<!-- Album Images -->
						<div class="album-images row">
							<?php foreach($boxes as $box){?>
							<!-- Album Image -->
							<div class="col-md-3 col-sm-4 col-xs-6">
								<div class="album-image">
									<a href="<?php echo site_url($box->box_name);?>" class="thumb">
										<?php
										if($box->box_image)
											echo img('blobfuse/images/'.$box->box_image,false,'class="img-responsive"');
										else
											echo img('assets/pages/images/news-image-widget.png',false,'class="img-responsive"');
										?>
									</a>
									
									<a href="<?php echo site_url($box->box_name);?>" class="name">
										<span><?php if($box->title) echo $box->title;else echo 'unknown';?></span>
										<em><?php echo time_ago_in_words(human_to_unix($box->reg_time));?> ago</em>
									</a>
									
									<div class="image-options">
										<!--a href="#" data-action="edit"><i class="fa-pencil"></i></a>
										<a href="#" data-action="trash"><i class="fa-trash"></i></a-->
									</div>
									
									
								</div>
							</div>
							<?php }?>
						</div>
						<?php }?>
						
						<!--button class="btn btn-white btn-block">
							<i class="fa-bars"></i>
							Load More Images
						</button-->
						
					</div>
					
					
				
				</div>
				
			</section>
