var uploadForm = $('#uploadForm');
var FormValidation = function () {
    var uploadValidation = function() {
            var error1 = $('.alert-danger', uploadForm);
            var success1 = $('.alert-success', uploadForm);
			
            uploadForm.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    
                },
                rules: {
                    price: {
                        required: true,
                        number: true,
						min:0
                    },
					category: {
                        maxlength: 50
                    },
					title: {
                        maxlength: 30
                    },
					description: {
                        maxlength: 140
                    },
					account_address:{
						required: true,
						bic:true
					},
					box_image:{
						accept:true
					}
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    if(jQuery('#dropzone-filetable tbody tr:not(.empty_row)').length==0)
					{
						$('#advancedDropzone_area').addClass('has-error');
					}else{
						label
							.closest('.form-group').removeClass('has-error'); // set success class to the control group
					}
                },
                submitHandler: function (form) {
                    if(jQuery('#dropzone-filetable tbody tr:not(.empty_row)').length==0)
					{
						$('#advancedDropzone_area').addClass('has-error');
					}else{
						success1.show();
						error1.hide();

						if ($('#lbl_currency_type').html()=='BTC') {
							$('#hd_price_btc').val($('#txt_price_download').val());
							form.submit();
						} else {
							$('#hd_price_btc').val($('#txt_price_download').val() / cur_rate);
							form.submit();
						}

						
					}
                }
            });
			
    }
	var initEvents = function() {
		$("#is_show").live('change',function(){
			if($(this).attr('checked')!='checked'){
				$('.only_publish').removeClass('display-hide');
				uploadForm.validate().settings.rules = 
				{
                    price: {
                        required: true,
                        number: true
                    },
					category: {
                        required: true,
						maxlength: 50
                    },
					title: {
                        required: true,
						maxlength: 30
                    },
					description: {
                        required: true,
						maxlength: 140
                    },
					box_image:{
						required: true,
						accept:true
					},
					pay_address: {
						required: true
					}
                };
			}else{
				$('.only_publish').addClass('display-hide');
				uploadForm.validate().settings.rules = 
				{
                    price: {
                        required: true,
                        number: true
                    },
					account_address:{
						required: true,
						alphanumeric:true
					}
                };
				
			}
		});

		$('#a_switch_usd').live('click', function(){

			if ($('#lbl_currency_type').html()=='BTC') {
				$('#lbl_currency_type').html('USD');
				$('#a_switch_usd').html('(switch to BTC)');
				$('#hd_price_btc').val($('#txt_price_download').val());
				var usdValue = $('#txt_price_download').val() * cur_rate;
				$('#txt_price_download').val(usdValue);
			}else{
				$('#lbl_currency_type').html('BTC');
				$('#a_switch_usd').html('(switch to USD)');
				var btcValue = $('#txt_price_download').val() / cur_rate;
				$('#txt_price_download').val(btcValue);
			}
		});
	}

    return {
        //main function to initiate the module
        init: function () {
            uploadValidation();
			initEvents();
        }
    };
}();

jQuery(document).ready(function() {
    FormValidation.init();
	
	$dropzone_filetable = $("#dropzone-filetable");
	dropzone = $("#advancedDropzone").dropzone({
		url: base_url+'upload/send',
		maxFilesize: max_size,
		// Events
		addedfile: function(file)
		{
			if(jQuery('#dropzone-filetable tbody tr:not(.empty_row)').length==0)
			{
				$dropzone_filetable.find('tbody').html('');
			}
			$('#advancedDropzone_area').removeClass('has-error');
			var size;
			if(file.size < 1024)
				size = file.size + " Byte";
			else if(file.size < (1024*1024))
				size = parseInt(file.size/1024, 10) + " KB";
			else
				size = parseInt(file.size/1024/1024, 10) + " MB";
			
			var	$el = $('<tr>\
							<td>'+file.name+'</td>\
							<td>'+size+'</td>\
							<td><div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div></td>\
						</tr>');
			$dropzone_filetable.find('tbody').append($el);
			file.fileEntryTd = $el;
			file.progressBar = $el.find('.progress-bar');
		},
		uploadprogress: function(file, progress, bytesSent)
		{
			file.progressBar.width(progress + '%');
		},
		success: function(file,response)
		{
			if(response.status==0)
				file.fileEntryTd.find('td:last').html('<span class="text-danger" title="'+response.error+'">Failed</span>');
			else
				file.fileEntryTd.find('td:last').html('<a id="btn_remove" data-id="'+response.id+'" class="btn btn-blue btn-xs">remove</a>');
			//file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');
		},
		error: function(file,message)
		{
			$("#uploadErrorBox .modal-title").text(message);
			jQuery('#uploadErrorBox').modal('show', {backdrop: 'fade'});
			file.fileEntryTd.find('td:last').html('<span class="text-danger">Failed</span>');
			//file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
		}
	});
	$("#advancedDropzone").css({
		minHeight: 200
	});
	$("#btn_remove").live('click',function(){
		var params={
			id:$(this).attr('data-id')
		};
		var trObject = $(this).parent().parent();
		trObject.remove();
		$.post(base_url+'upload/remove', params, function(response) {
			//if(response.status==0)
				//trObject.remove();
		});
		if(jQuery('#dropzone-filetable tbody tr').length==0){
			jQuery('#dropzone-filetable tbody').html('<tr class="empty_row"><td>Files list will appear here.</td></tr>');
			$('#advancedDropzone_area').addClass('has-error');
		}
	});	
});