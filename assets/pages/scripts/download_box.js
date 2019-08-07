function paycheck(){
	jQuery.ajax({
			url: base_url+"download/paycheck/"+$("#box_id").val(),
			success: function(response){
				if(response.status==true)
					window.location.href = base_url+'purchased/'+response.dlcode;
				else
					setTimeout("paycheck()",5000);
			}
		});
}
function blockUI(options) {
            var options = $.extend(true, {}, options);
            var html = '';
            if (options.iconOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '')+'"><img src="'+base_url +'assets/global/img/loading-spinner-grey.gif" align=""></div>';
            } else if (options.textOnly) {
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '')+'"><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            } else {    
                html = '<div class="loading-message ' + (options.boxed ? 'loading-message-boxed' : '')+'"><img src="'+base_url +'assets/global/img/loading-spinner-grey.gif" align=""><span>&nbsp;&nbsp;' + (options.message ? options.message : 'LOADING...') + '</span></div>';
            }

            if (options.target) { // element blocking
                var el = $(options.target);
                if (el.height() <= ($(window).height())) {
                    options.cenrerY = true;
                }            
                el.block({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    centerY: options.cenrerY != undefined ? options.cenrerY : false,
                    css: {
                        top: '10%',
                        border: '0',
                        padding: '0',
						width:'100%',
						position: 'relative',
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#000',
                        opacity: options.boxed ? 0.05 : 0.1, 
                        cursor: 'wait'
                    }
                });
            } else { // page blocking
                $.blockUI({
                    message: html,
                    baseZ: options.zIndex ? options.zIndex : 1000,
                    css: {
                        border: '0',
                        padding: '0',
						width:'100%',
						position: 'relative', 
                        backgroundColor: 'none'
                    },
                    overlayCSS: {
                        backgroundColor: options.overlayColor ? options.overlayColor : '#000',
                        opacity: options.boxed ? 0.05 : 0.1,
                        cursor: 'wait'
                    }
                });
            }            
        }
$(document).ready(function(){
	$("#btnEscrow").live('click',function(){
		$("#form_escrow_purchase").submit();
		
	});
	$("#btnChoosePurcharse").live('click',function(){
		jQuery('#modal-pay-confirm').modal('show', {backdrop: 'static'});
	});	
	$(".btnPurcharse").live('click',function(){
		
		jQuery('#modal-pay-confirm').modal('hide');
		var boxId = $(this).attr('data-box-id');
		jQuery('#purchase_modal').modal('show', {backdrop: 'static'});
		jQuery.ajax({
			url: base_url+"download/show_pay_info/"+boxId,
			success: function(response)
			{
				jQuery('#purchase_modal .modal-body').html(response);
				//jQuery('#purchase_modal').modal('hide');
				//public_vars.$pageLoadingOverlay.removeClass('loaded');
				blockUI({
					target: '#blockui_sample_1_portlet_body',
					message:'Waiting for payment... please do not press back or refresh.'
				});

				//$("#form_purchased").submit();
				paycheck();
			}
		});
		
		
	});
	$('#btn_purchased').live('click',function(){
		/*
		jQuery('#purchase_modal').modal('hide');
		public_vars.$pageLoadingOverlay.removeClass('loaded');
		//$("#form_purchased").submit();
		paycheck();*/
	});
	$("#reviewForm").ajaxForm({
		beforeSerialize:function(){
			for(var i=0;i<$(".make-rating input[type=radio]").length;i++)
			{
				if($($(".make-rating input[type=radio]")[i]).attr("checked")=="checked")
					ratingVal=i;

			}
			$("#ratingVal").val(5-ratingVal);

		},
		beforeSend:function(){
			$("#ratingVal").val(5);
			console.log($("#ratingVal").val());
		},
		beforeSubmit:function(){
			var ratingVal = 0;
			if($("#review_comment").val()==""){
				$.msgbox("Please type for recomment.", {type: "info", buttons: [{type: "submit", value: "OK"}]});
				return false;
			}
			// for(var i=0;i<$(".make-rating input[type=radio]").length;i++)
			// {
			// 	if($($(".make-rating input[type=radio]")[i]).attr("checked")=="checked")
			// 		ratingVal=i+1;

			// }
			if($("#ratingVal").val()==0){
				$.msgbox("Please select for rating.", {type: "info", buttons: [{type: "submit", value: "OK"}]});
				return false;	
			}
			return true;
		},
		uploadProgress:function(a,b,c,d){
			
		},
		success:function(data){
			window.location.reload();
		}
	});
});
