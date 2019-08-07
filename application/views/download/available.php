	
	<div class="page-error centered">
		
		<div class="error-symbol">
			<i class="a-files-o"></i>
			Welcome to <?php echo SITE_TITLE;?>!
		</div>
		
		<h3>
			Box : <small><?php echo strtoupper($box->box_name);?></small>
		</h3>
		<section class="user-timeline-stories">
			<article class="timeline-story">
				<header>
				<?php if($box->user_id && $box->is_show){?>	
					<div class="xe-widget xe-single-news">
						<div class="xe-image">
							<?php echo img('blobfuse/images/'.$box->box_image);?>
							<span class="xe-gradient"></span>
						</div>
						
						<div class="xe-details">
							<h3>
								<a href="#"><?php echo $box->title;?></a>
							</h3>
							<div class="category">
								Category : <a href="#"><?php echo $box->category;?></a>
								<a href="#">
									<div>
										<div style="float: left">
											<i class="linecons-user"></i> <?php if($user){?>Published by <?php echo $user->user_name; } ?>&nbsp;&nbsp;
										</div>
										<?php echo_rating_stars($user_rating);?>	
									</div>
								</a>
							</div>
							<time><?php echo time_ago_in_words(human_to_unix($box->reg_time));?></time>
						</div>
					</div>
				<?php }?>
				</header>
				<div class="story-content">
					<?php if($box->user_id && $box->is_show){?>	
					<p><?php echo $box->description;?></p>
					<?php }?>
					<?php if($box->is_show && false){?>
					<!-- Story Options Links -->
					<div class="story-options-links">
						<a href="#">
							<i class="linecons-comment"></i>
							Comments
							<span>(<?php if($comments) echo count($comments);else echo 0;?>)</span>
						</a>
					</div>
					<?php }?>
					<?php if($comments){?>
					<!-- Story Comments -->
					<ul class="list-unstyled story-comments">
						<?php foreach($comments as $comment){?>
						<li>
							<div class="story-comment">
								<div class="story-comment-content">
									<a class="story-comment-user-name">
										<time>
											<?php echo time_ago_in_words(human_to_unix($comment->created_at));?>
										</time>
										<?php echo_rating_stars($comment->rating);?>
									</a>
									<p><?php echo $comment->comment;?></p>
								</div>
							</div>
							
						</li>
						<?php }?>
					</ul>
					<?php }?>
					<?php if($box->is_show){?>
					<form method="post" action="" id="reviewForm" class="story-comment-form">
						<input type=hidden name='comment_action' value='1'/>
						<input type=hidden name='box_id' value='<?php echo $box->id;?>'/>
						<input type=hidden name='ratingVal' id='ratingVal' value='0'/>
						<textarea name='comment' id='review_comment' class="form-control input-unstyled autogrow" placeholder="Reply..." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 58px;"></textarea>
						<div class="make-rating">
							<input type="radio" name="stars-rating" id="stars-rating-5">
							<label for="stars-rating-5"><i class="fa fa-star"></i></label>
							<input type="radio" name="stars-rating" id="stars-rating-4">
							<label for="stars-rating-4"><i class="fa fa-star"></i></label>
							<input type="radio" name="stars-rating" id="stars-rating-3">
							<label for="stars-rating-3"><i class="fa fa-star"></i></label>
							<input type="radio" name="stars-rating" id="stars-rating-2">
							<label for="stars-rating-2"><i class="fa fa-star"></i></label>
							<input type="radio" name="stars-rating" id="stars-rating-1">
							<label for="stars-rating-1"><i class="fa fa-star"></i></label>
							Rating
						</div>
						<br/>
						<button class="btn btn-blue btn-xs pull-right">Submit</button>
					</form>
					<?php }?>
				</div>
				
			</article>
		</section>
		<div class="xe-widget xe-counter">
			<table class="table table-hover middle-align">
				<thead>
					<tr>
						<th colspan=3></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($files)>0){
						foreach($files as $file){
					?>
					
					<tr data-skin="">
						<td>
							<!--a href="#" class="skin-name-link">Default Skin</a-->
							<?php echo $file->original_filename;?>
						</td>
						<td>
							<?php echo format_from_kb($file->file_size);?>
						</td>
						<td>
							<?php 
								echo anchor("download/force/".$file->id,'<i class="fa-download"></i><span>Download</span>','class="btn btn-purple btn-icon btn-icon-standalone btn-xs pull-right"');
							?>
						</td>
					</tr>
						<?php }}?>
				</tbody>
			</table>
		</div>
	</div>
	

	