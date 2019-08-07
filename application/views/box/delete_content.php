						<div class="col-sm-8 panel-body-right">
							<?php
								$attributes = array('method' => 'post', 'role' => 'form', 'id' => 'del_box_from_box_id');
								echo form_open('box/delete_box_from_box_id', $attributes);
							?>
								<input type="hidden" name="box_id" value="<?php echo $box_id?>">
							<?php echo form_close(); ?>

							<div class="portlet light portlet-fit ">
                                <div class="portlet-body">
									<div class="form-actions">
										<label>
										<a id="a_delete_content" box_id="<?php echo $box_id;?>" href="javascript:;" class="btn btn-primary btn-single btn-lg">Delete box with all files</a>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="modal-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Are you sure?</h4>
						</div>
						
						<div class="modal-body">
							Delete box with all files!
						</div>
						<div class="modal-footer">
								<button id="btn_cancel" type="button" class="btn btn-white" data-dismiss="modal">Close</button>
								<button id="btn_confirm" type="submit" class="btn btn-info" data-dismiss="modal">Confirm</button>
						</div>
					</div>
				</div>
			</div>