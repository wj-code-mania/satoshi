						<div class="col-sm-8 panel-body-right">	
							<div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
										<span class='caption-subject bold uppercase'>
											<i class='fa fa-btc'></i> Balance withdrawal
										</span>
									</div>
									
                                </div>
                                <div class="portlet-body">
                                	<?php //foreach ($balance_list as $balance) { ?>
                                	<?php
										$attributes = array('method' => 'post', 'role' => 'form', 'id' => 'BTC-withdrawal-form', 'class' => 'withdrawal-form');
										echo form_open('user/withdrawal', $attributes);
									?>
									
                                	<div class="form-group">
										<label>Your BTC balance is <?php echo round_value_by_template($userdata->balance)?> BTC</label>
										<?php if ($userdata->balance == 0) { ?>
										<div class="alert alert-danger">
											<strong>Not enough balance</strong> 
										</div>
										<?php } ?>
									</div>
									<div class="form-group">
										<label class="control-label">Your BTC address</label>
										<div>
											<input type="" name="address" <?php if ($userdata->balance == 0) { ?>disabled<?php }?> class="form-control"> 
										</div>
									</div>
									<div class="form-actions">
											<button type="submit" class="btn btn-primary btn_send_coin">Send me my coins!</button>
									</div>
									<?php echo form_close(); ?>
									<?php //} ?>
									
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>