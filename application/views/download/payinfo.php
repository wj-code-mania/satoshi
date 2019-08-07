<?php
$attributes = array('method' => 'post', 'id' => 'form_purchased');
echo form_open('download/purchase', $attributes);
?>	
	<?php 
		$to_address = $coin_address;
		/*if($box->user_id)
			$to_address = $server_coin;
		else
			$to_address = $box->seller_account;*/
	?>
	<input type='hidden' id="box_id" name='box_id' value='<?php echo $box->id;?>'/>
	<input type='hidden' name='to_address' value='<?php echo $to_address;?>'/>
	<div class="form-group">
		<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin:<?php echo $to_address;?>?&amount=<?php echo $box->price;?>" style="margin-left: auto;margin-right: auto;display: block;">
	</div>
	<div class="form-group">
		<label class="control-label">To address</label>
		<div class='input-group'>
			<pre class="form-control no-right-border form-focus-purple"><?php echo $to_address;?></pre>
			<span class="input-group-btn">
					<button class="btn btn btn-success copy-clipboard" data-id="clipboard_to_address" type="button">Copy</button>
					
			</span>
			<input type='text' class='hide-clipboard-input' value="<?php echo $to_address;?>" id="clipboard_to_address">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label">Pay amount</label>
		<div class='input-group'>
			<pre class="form-control no-right-border form-focus-purple"><?php echo $box->price;?></pre>
			<span class="input-group-btn">
				<button class="btn btn btn-success copy-clipboard" data-id="clipboard_price" type="button">Copy</button>
			</span>
			<input type='text' class='hide-clipboard-input' value="<?php echo $box->price;?>" id="clipboard_price">
		</div>
	</div>

	<div class="form-group">
		<center>
			<?php echo anchor("https://www.blockchain.com/btc/address/".$to_address,"<i class='fa fa-link'></i> bitcoin:".$to_address,"target='_blank'");?>
		</center>
	</div>
<?php echo form_close();?>	
