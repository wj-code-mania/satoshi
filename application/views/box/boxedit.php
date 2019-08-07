						<div class="col-sm-8 panel-body-right">	
						<?php
							$attributes = array('id' => 'uploadForm','enctype'=>"multipart/form-data");
							echo form_open('box/update', $attributes);
							echo form_hidden('box_id', $box_id);
						?>
							<div class="portlet light portlet-fit ">
                                <div class="portlet-body">
                                	<div class="alert alert-success display-hide">
	                                    <button class="close" data-close="alert"></button> Your box details changed successfully! </div>
									<div class="form-group">
										<label>Box name</label>
										<div>
											<input disabled type="text" class="form-control" value="<?php echo $box->box_name; ?>" 
											/> 
										</div>	
									</div>
									<div class="form-group">
										<label>Longer description</label>
										<div>
											<textarea id="description" name="description" class="form-control"><?php echo $box->description; ?></textarea> 
										</div>	
									</div>
									<div class="form-group">
										<label>Message for paying customers</label>
										<div>
											<textarea id="msg_customers" name= "msg_customers" class="form-control" ><?php echo $box->msg_customers; ?></textarea> 
										</div>	
									</div>
									<div class="form-group">
										<label><input type='checkbox' class='cbr' id="is_show" name="is_show" <?php echo $box->is_show == 1 ? '' : 'checked'; ?>/> Not published on board </label>
									</div>
									<div class="form-group only_publish published <?php echo $box->is_show == 1 ? '' : 'display-hide'; ?>">
										<label>Category</label>
										<div>
											<input id= "category" type="text" name="category" class="form-control" value="<?php echo $box->category; ?>"/>
										</div>	
									</div>
									<div class="form-group only_publish published <?php echo $box->is_show == 1 ? '' : 'display-hide'; ?>">
										<label>Title</label>
										<div>
											<input id= "title" type="text" name="title" class="form-control" value="<?php echo $box->title; ?>"/>
										</div>	
									</div>
									<div class="form-group only_publish published <?php echo $box->is_show == 1 ? '' : 'display-hide'; ?>">
										<label>Reference image Upload</label>
										<?php echo img('blobfuse/images/'.$box->box_image,false,"width=50 height=50");?>
										<div>
											<input type="file" name="box_image" id="box_image" class="form-control" />
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save change</button>
									</div>
								</div>
							</div>
						</div>
						<?php form_close();?>
					</div>
				</div>
			</div>