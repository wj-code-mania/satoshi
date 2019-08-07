						<div class="col-sm-8 panel-body-right">	
							<div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h3>Change your contact email</h3>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                	<input type="hidden" id="is_changed" value="<?php echo $is_changed; ?>" />
									<?php
										$attributes = array('method' => 'post', 'role' => 'form', 'id' => 'changeemail-form');
										echo form_open('user/changeemail', $attributes);
									?>
									<div class="alert alert-success display-hide">
	                                    <button class="close" data-close="alert"></button> Your contact email changed successfully! </div>
									<div class="form-group">
										<label class="control-label">Email</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
											</span>
											<input name="email" id="email" type="" class="form-control" value="<?php echo $userdata->email; ?>" placeholder="test@icloud.com"> 
										</div>
									</div>
									<div class="form-group margin-top-20 margin-bottom-20">
										<label class="check">
											Do not send me any payment notices
											<input type="checkbox" class='cbr' name="payment_notice" id="payment_notice" <?php echo $userdata->payment_notice == 1 ? '' : 'checked'; ?> />
										</label>
									</div>
									
									<div class="form-actions">
										<button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>