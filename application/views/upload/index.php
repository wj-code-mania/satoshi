<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<h3>File Upload Box
				<small class="description">file uploading and processing via this page</small>
			</h3>
			
		</h3>
	</div>
	<div class="panel-body">
		<?php
			$attributes = array('id' => 'uploadForm',"enctype"=>"multipart/form-data");
			echo form_open('box/save', $attributes);
		?>
		<div id="advancedDropzone_area" class="row">
			<div class="col-sm-3 text-center">
				<div id="advancedDropzone" class="droppable-area">
					Drop Files Here (Max:<?php echo $max_upload_size;?>MB)
					 
				</div>
			</div>
			<div class="col-sm-9">
				<table class="table table-striped" id="dropzone-filetable">
					<tbody>
						<?php 
						if($upload_files!=false){
							foreach($upload_files as $file)
							{
						?>
					<tr>
						<td><?php echo $file->original_filename;?></td>
						<td><?php echo format_from_kb($file->file_size);?></td>
						<td><button id='btn_remove' data-id=<?php echo $file->id;?> class='btn btn-blue btn-xs'>remove</button></td>
					</tr>		
						<?php }
						}else{
							echo "<tr class='empty_row'><td>Files list will appear here.</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class='row'>
			
			
			<!--div class='col-sm-3'>
				<div class="form-group">
					<label class="control-label">Select coin type</label>
					<select id="server_coin_id" name="server_coin_id" class="form-control">
						<?php 
							/*
							if($server_coins){
								foreach($server_coins as $coin){
						?>
						<option value=<?php echo $coin->id;?>><?php echo $coin->coin_type;?></option>
						
						<?php 	}
							}*/
						?>
					</select>
				</div>
			</div-->
			<div class='col-sm-12'>
				<div class="form-group">
					<label class="control-label">Price for download</label>
					<input id="txt_price_download" type="text" data-mask='fdecimal' class="form-control" name="price" data-validate="number" placeholder="" />
					<input id="hd_price_btc" type="hidden" class="form-control" name="price_btc"/>
					<span class="help-block">
						<label id="lbl_currency_type">BTC</label>
						<a href="javascript:;" id="a_switch_usd">(switch to USD) </a>
						<label id="lbl_currency_rate">1 BTC is <?=$cur_rate?> USD</label>
					</span>
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-6'>
				<?php if($this->session->has_userdata(SESSION_NAME)){?>
				<div class="form-group only_publish display-hide">
					<label class="control-label">Category</label>
					<input type="text" class="form-control" name="category" placeholder="Example:Computer,Sports,Mobile ..." />
				</div>
				<?php }?>
			</div>
			<div class='col-sm-6'>
				<?php if($this->session->has_userdata(SESSION_NAME)){?>
				<div class="form-group only_publish display-hide">
					<label class="control-label">Title</label>
					<input type="text" class="form-control" name="title" placeholder="" />
				</div>
				<?php }?>
			</div>
		</div>
		<?php if($this->session->has_userdata(SESSION_NAME)==false){?>
		<div class="form-group">
			<label class="control-label">Your bitcoin address</label>
			<div class = "row">
				<div class="col-sm-12">
					<input type="text" class="form-control" name="pay_address" data-validate="alphanumeric" placeholder="eg. bc1qww508d6qejxtdg4y5r3zavary0c5xw7kv8f3t4" required>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($this->session->has_userdata(SESSION_NAME)){?>
		<div class="form-group only_publish display-hide">
			<label class="control-label">Description</label>
			<div class = "row">
				<div class="col-sm-10">
					<textarea id='description' name='description' class="form-control autogrow" cols="5" id="field-5" placeholder="I will grow as you enter new lines."></textarea>
				</div>
			</div>
		</div>
		<div class="form-group only_publish display-hide">
			<label class="control-label">Reference image</label>
			<div class = "row">
				<div class="col-sm-10">
					<input type="file" name="box_image" id="box_image" class="form-control" />
				</div>
			</div>
		</div>
		<?php }?>
		<?php if($this->session->has_userdata(SESSION_NAME)){?>
		<div class="form-group">
			<label>
				<input type="checkbox" class="cbr" id='is_encrypt' name='is_encrypt' value='1' >

				<span>Encrypt files before upload</span>
			</label>
		</div>
		<?php }?>
		<div class="form-group">
			<label>
				<input type="checkbox" class="cbr" id='is_show' name='is_show' value='1' checked>

				<span>Not publish on board</span>
			</label>
		</div>
		<div class="form-action">
			<button class="btn btn-info btn-icon">
				<i class="fa-upload"></i>
				<span>Upload and share!</span>
			</button>
		</div>
		</form>
	</div>
</div>
<div class="modal fade" id="uploadErrorBox">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style="color: #000;"></h4>
			</div>
			
			<div class="modal-footer">
				<button id="btn_confirm" type="submit" class="btn btn-info" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>

<script>
	var max_size = <?php echo $max_upload_size;?>;
	var cur_rate = "<?php echo $cur_rate?>";
</script>