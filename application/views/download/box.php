	<div class="page-error centered">
		<div class="error-symbol">
			<i class="fa-files-o"></i>
			Welcome to <?php echo SITE_TITLE;?>!
		</div>
		<h3>
			Box <small><?php echo strtoupper($box->box_name);?></small> <button data-id="clipboard_box_url" class="btn btn-success copy-clipboard">Copy to Clipboard</button>
			<input type='text' class='hide-clipboard-input' value="<?php echo site_url($box->box_name);?>" id="clipboard_box_url">
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
							<div class="category">
								<a href="#"><?php echo $box->category;?></a>
							</div>
							
							<h3>
								<a href="#"><?php echo $box->title;?></a>
							</h3>
							
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
							<i class="linecons-heart"></i>
							Rate 
							<span>(3)</span>
						</a>
						
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
										<time><?php echo time_ago_in_words(human_to_unix($comment->created_at));?></time>
										<?php echo_rating_stars($comment->rating);?>
									</a>
									<p><?php echo $comment->comment;?></p>
								</div>
							</div>
							
						</li>
						<?php }?>
					</ul>
					<?php }?>
					<?php if($box->is_show){/*?>
					<form method="post" action="" class="story-comment-form">
						<input type=hidden name='box_id' value='<?php echo $box->id;?>'/>
						<textarea name='comment' class="form-control input-unstyled autogrow" placeholder="Reply..." style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 58px;"></textarea>
						<br/>
						
						<button class="btn btn-blue btn-xs pull-right">submit</button>
					</form>
					<?php */}?>
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
					if($files > 0){
						foreach($files as $file){
					?>
					
					<tr data-skin="">
						<td>
							<!--a href="#" class="skin-name-link">Default Skin</a-->
							<?php echo $file->original_filename;?>
						</td>
						<td style='text-align:right'>
							<?php echo format_from_kb($file->file_size);?>
						</td>
					</tr>
						<?php }}?>
				</tbody>
			</table>
			<center>
				<?php if(!$tradeData){?>
					<?php if($this->session->has_userdata(SESSION_NAME)){?>
						<button id="btnChoosePurcharse" data-box-id=<?php echo $box->id;?> class="btn btn-primary btn-lg">Buy for <?php echo $box->price." BTC";?></button>
					<?php }else{?>
						<button data-box-id=<?php echo $box->id;?> class="btn btn-primary btn-lg btnPurcharse">Buy for <?php echo $box->price." BTC";?></button>
					<?php }?>
				<?php }else{
						$download_data = $tradeData->download_key."_".$tradeData->box_id;
						echo anchor('purchased/'.bin2hex($download_data), 'Download', 'class="btn-primary btn-lg"');
						
					}
					?>
			</center>
		</div>
	</div>
	

	<div class="page-error-search centered">
		<?php echo anchor("/",'<i class="fa-angle-left"></i> Go Home','class="go-back"');?>
	</div>
<div class="modal fade" data-backdrop="static" id="purchase_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<!--button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button-->
					<h4 class="modal-title"><h1 class='title'><i class='fa fa-btc'></i> <?php echo SITE_TITLE;?></h1></h4>
				</div>
				
				<div class="modal-body">
				</div>
				<div class="modal-footer" style="height: 56px;" id="blockui_sample_1_portlet_body">
					<!--button type="button" id='btn_purchased' class="btn btn-info">Pay Now</button-->
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-pay-confirm">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">
						Choose payment.
					</h4>
				</div>
				
				<div class="modal-body">
					<?php 
						if($escrow > $box->price) echo "You can buy for your escrow.";
						else echo "You can't buy for your escrow.";
					?>
					<?php
						$attributes = array('method' => 'post', 'id' => 'form_escrow_purchase');
						echo form_open('download/escrow_purchase', $attributes);
						$data = array(
								'box_id'  => $box->id
						);
						echo form_hidden($data);
						echo form_close();
					?>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<button type="button" <?php echo ($escrow > $box->price)? "":"disabled"; ?> id="btnEscrow" class="btn btn-success">For escrow</button>
					<button data-box-id=<?php echo $box->id;?> class="btn btn-primary btnPurcharse">For BTC</button>
				</div>
			</div>
		</div>
	</div>

	<!--div class="page-loading-overlay loaded" style="background: #fff;">
		<div>
			<span class="fa fa-spin fa-spinner" style="position:absolute;left:47%;top:41%;font-size:120px;"></span>
		</div>
		<div>
			<p style="position:absolute;left:25%;top:62%;font-size:32px;">Waiting for payment... please do not press back or refresh.</p>
		</div>
	</div-->
