		<footer class="main-footer sticky footer-type-1">
			<div class="footer-inner">
				<div class="footer-text">&copy; 2019 <strong><?php echo SITE_TITLE;?></strong></div>
			</div>
		</footer>
	</div>
</div>

<?php 
	echo $this->javascript->external('assets/global/scripts/TweenMax.min.js',false);
	echo $this->javascript->external('assets/global/scripts/joinable.js',false);
	echo $this->javascript->external('assets/global/scripts/xenon-api.js',false);
	echo $this->javascript->external('assets/global/scripts/xenon-toggles.js',false);
	echo $this->javascript->external('assets/global/plugins/toastr/toastr.min.js',false);
	echo $this->javascript->external('assets/global/scripts/xenon-custom.js',false);
	foreach($scripts as $script){
		echo $this->javascript->external($script,false);
	}
?>

</body>
</html>