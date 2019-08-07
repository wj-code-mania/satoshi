						<div class="col-sm-8 panel-body-right">	
							<div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h3>Delete box after one sale</h3>
                                    </div>
                                </div>
                                <div class="portlet-body">

									<?php
										$attributes = array('method' => 'post', 'role' => 'form', 'id' => 'changeonceonly-form');
										echo form_open(null, $attributes);
									?>
									<div class="alert alert-success display-hide">
	                                    <button class="close" data-close="alert"></button> Your Sell Once Only changed successfully! </div>
									<div class="form-group">
										<div class="input-group">
											<label class="check">
												Sell Once Only &nbsp;&nbsp;&nbsp;
												<?php 
												$data = array(
												        'name'          => 'check_sell_once',
												        'id'            => 'check_sell_once',
												        'class'         => 'form-control cbr',
												        'data-validate' => 'number',
												        'box_id'        =>  $box_id,
												        'checked'       =>  $current_once_only
												);
												echo form_checkbox($data);
												?>
											</label>
											
										</div>
									</div>
							
									<div class="form-actions">
										<button id = "btn_sell_once_only" type="submit" class="btn btn-success uppercase pull-left">Save change</button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>