						<div class="col-sm-8 panel-body-right">		
							<div class="portlet light portlet-fit ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <h3>Payment button for your web</h3>
                                    </div>
                                </div>
                                <div class="portlet-body">
									<div class="form-group">
										<input id="text_pay_url" type="text" class="form-control" name="number" data-validate="number" value='<?php echo site_url($box_name); ?>' disabled/>
									</div>
									<div class="form-actions">
											<button id = "btn_clipboard" data-id="share_url_clipboard_input" type="button" class="btn btn-success copy-clipboard">Copy to clipboard</button>
									</div>
									<input type='text' class='hide-clipboard-input' value="<?php echo site_url($box_name);?>" id="share_url_clipboard_input">
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>