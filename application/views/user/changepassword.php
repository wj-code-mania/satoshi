					<div class="col-sm-8 panel-body-right">		
							<div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h3>Set new password</h3>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                	<input type="hidden" id="is_changed" value="<?php echo $is_changed; ?>" />
									<?php
										$attributes = array('method' => 'post', 'role' => 'form', 'id' => 'changepassword-form');
										echo form_open('user/changepassword', $attributes);
									?>
	                                <div class="alert alert-success display-hide">
	                                    <button class="close" data-close="alert"></button> Your password changed successfully! </div>
									<div class="form-group">
										<label class="control-label">Current Password</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input name="curpassword" id="curpassword" type="password" class="form-control" placeholder="Current Password"> </div>
									</div>
									<div class="form-group">
										<label class="control-label">Password</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input name="password" id="passwd" type="password" class="form-control" placeholder="Password"> </div>
									</div>
									<div class="form-group">
										<label class="control-label">Repeat Password</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input name="repassword" id="repasswd" type="password" class="form-control" placeholder="Repeat Password"> 
										</div>
									</div>
									
									<div class="form-actions">
										<button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
									</div>
									<?php echo form_close()?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>