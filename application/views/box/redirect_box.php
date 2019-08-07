						<div class="col-sm-8 panel-body-right">	
							<div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h3>Redirect to other box URL address</h3>
                                    </div>
                                </div>
                                <div class="portlet-body">

									<?php
										$attributes = array('method' => 'post', 'role' => 'form', 'id' => 'changeredirectemail-form');
										echo form_open(null, $attributes);
									?>
									<div class="alert alert-success display-hide">
	                                    <button class="close" data-close="alert"></button> Your redirect URL changed successfully! </div>
									<div class="form-group">
										<label class="control-label">URL</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-envelope"></i>
											</span>
											<?php 
												$data = array(
												        'name'          => 'redirect_url',
												        'id'            => 'redirect_url',
												        'value'         => $current_redirect_url,
												        'class'         => 'form-control',
												        'placeholder'   => 'Currenct Redirect URL:',
												        'data-validate' => 'number',
												        'box_id'        =>  $box_id
												);
												echo form_input($data);
											?>
										</div>
									</div>
									<div class="form-actions">
										<button id = "redirect_url" type="submit" class="btn btn-success uppercase pull-right">Save Change</button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>