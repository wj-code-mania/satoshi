<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<h3>File Upload Box
							<small class="description">file uploading and processing via this page</small>
						</h3>
						
					</h3>
				</div>
				<div class="panel-body">
					<br/>
					<div class="row">
						<div class="col-sm-3 text-center">
							<div id="advancedDropzone" class="droppable-area">
								Drop Files Here
							</div>
						</div>
						<div class="col-sm-9">
							<table class="table table-bordered table-striped" id="example-dropzone-filetable">
								<thead>
									<tr>
										<th width="1%" class="text-center"></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="2">Files list will appear here</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class='row'>
						<div class='col-sm-6'>
							<div class="form-group">
								<label class="control-label">Price for download</label>
								<div class = "row">
									<div>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="number" data-validate="number" placeholder="Numeric Field">
										</div>
										<div class="text-left col-sm-8">
											<label class="control-label">BTC
												<a href="">(switch to usd)</a>->$39.38
											</label>
										</div>
									</div>
									<div></div>
								</div>
							</div>
						</div>
						<div class='col-sm-6'>
							<div class="form-group published">
								<label class="control-label">Title</label>
								<div class = "row">
									<div>
										<div class="col-sm-12">
											<input type="text" class="form-control" placeholder="Title">
										</div>
									</div>
									<div></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Description</label>
						<div class = "row">
							<div class="col-sm-12">
								<!-- <textarea class="description_textarea"></textarea> -->
								<textarea class="form-control">
									
								</textarea>
							</div>
						</div>
					</div>
					<div class="form-group published">
						<label class="control-label">Refrence image Upload</label>
						<div class = "row">
							<div class="col-sm-12">
								<!-- <textarea class="description_textarea"></textarea> -->
								<input type='file'/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" class="cbr cbr-done">
							<span>Encrypt files before upload</span>
						</label>
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" id='check_publish' checked>
							<span>Not publish on board</span>
						</label>
					</div>
					<div class="form-group">
						<button class="btn btn-info btn-icon">
							<i class="fa-upload"></i>
							<span>Upload and share!</span>
						</button>
					</div>
				</div>
			</div>